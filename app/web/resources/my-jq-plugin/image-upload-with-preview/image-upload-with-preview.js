// https://codepen.io/siremilomir/pen/jBbQGo
!function ($) {
    "use strict";

    /* CLASS DEFINITION */
    var ImageUploadWithPreview = function (element, options) {
        this.$element = $(element);
        this.options = $.extend({}, $.fn.imageUploadWithPreview.defaults, options)
        this.inputId = this.options.inputId || 'image-edit-input';
        this.imageBlob = null;
        this.init();
    };
    var proto = ImageUploadWithPreview.prototype;

    proto.getImage = function () {
        var $preview = this.$element.find('.image-preview-content');
        if(this.imageBlob) {
            return this.imageBlob
        } else {
            return $preview.prop('src');
        }
    };

    proto.setImage = function (obj) {
        var $preview = this.$element.find('.image-preview-content');
        if(this.imageBlob) {
            URL.revokeObjectURL($preview.prop('src'));
        }

        var img = obj;
        if(obj instanceof Blob) {
            this.imageBlob = obj;
            img = URL.createObjectURL(obj);
        }
        $preview.prop('src', img).hide().fadeIn(650);
    };

    proto.showCropModal = function (file, reader) {
        var self = this;
        $('#crop-modal').modal('toggle');
        $('#crop-modal-img').prop('src', reader.result);
        $('body').on('click', '#crop-modal-ok', function() {
            if(window.yeaCrop) {
                var canvas = window.yeaCrop.getCroppedCanvas({   // set final size
                    width: 300,
                    height: 300
                });
                canvas.toBlob(function(blob) {
                    blob.name = file.name;
                    blob.lastModified = file.lastModified;
                    self.setImage(blob);
                    $('#crop-modal').modal('toggle');
                });
            }
        }).on('click', '#crop-modal-cancel', function() {
            $('#crop-modal').modal('toggle');
        });
    };

    proto.readURL = function (input) {
        var self = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                if(self.options.useCropModal) {
                    self.showCropModal(input.files[0], reader);
                } else {
                    self.setImage(e.target.result);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    };

    proto.init = function () {
        var self = this;
        var inputId = this.inputId;
        var initImage = self.options.initImage || "/upload/avatar/placeholder.png";
        this.$element.html(`
<div class="image-upload-with-preview">
    <div class="image-edit">
        <input type='file' id="${inputId}" accept=".png, .jpg, .jpeg" />
        <label for="${inputId}"></label>
    </div>
    <div class="image-preview">
        <img class="image-preview-content" src="${initImage}" width="180px" height="180px">
    </div>
</div>
        `);

        $(`#${inputId}`).change(function() {
            self.readURL(this);
        });
    };

    proto.destroy = function () {
        this.$element.empty();
        this.$element.html('');
    };

    /* PLUGIN DEFINITION */
    var old = $.fn.imageUploadWithPreview;

    $.fn.imageUploadWithPreview = function (option, arg1) {
        var result = this.each(function () {
            var $this = $(this),
                data = $this.data('imageUploadWithPreview'),
                options = typeof option == 'object' && option;
            if (!data) $this.data('imageUploadWithPreview', (data = new ImageUploadWithPreview(this, options)));
            // option
            switch (option) {
                case 'setImage':
                    data.setImage(arg1);
                    break;
            }
        });
        if(option=='getImage') {
            var $el = $(this[0]);
            var ins = $el.data('imageUploadWithPreview');
            return ins.getImage();
        } else {
            return result;
        }
    };

    $.fn.imageUploadWithPreview.defaults = {
        inputId: 'image-edit-input',
        useCropModal: false,
        initImage: ''
    };

    $.fn.imageUploadWithPreview.Constructor = ImageUploadWithPreview;

    /* NO CONFLICT */
    $.fn.imageUploadWithPreview.noConflict = function () {
        $.fn.imageUploadWithPreview = old;
        return this
    }

    /* DATA-API */

}(window.jQuery);