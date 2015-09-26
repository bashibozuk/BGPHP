/**
 * Created by vasil on 8/26/15.
 */
function Form(config) {
    this.$form = config.form ? $(config.form) : undefined;
    this.validators = typeof config.validators == 'object' ? config.validators : {};
    this.errors = {};
}

Form.prototype.validate = function() {
    this.errors = {};
    var _this = this;
    $('input, textarea, select', this.$form).each(function(){
        var type = this.getAttribute('type');
        var name = this.getAttribute('name');

        if (!(name in _this.errors)) {
            _this.errors[name] = [];
        }

        if (typeof  _this.validators[name] == 'function'){
            var value = this.value;
            if (this.type == 'checkbox' || this.type == 'radio') {
                value = this.checked ? value : '';
            }

            _this.validators[name].call(_this, _this.errors[name], value);
        }
    });

    for (var i in this.errors) {
        if (this.errors.hasOwnProperty(i) && this.errors[i].length) {
            return false;
        }
    }

    return true;

}

Form.prototype.applyToForm = function() {
    var errorsWithoutField = [];
    for (var i in this.errors) {
        var $field = this.$form.find('[name=' + i + ']');
        var $errorContainer = this.getErrorContainer($field);
        if (!$errorContainer.length && this.errors[i].length) {
            errorsWithoutField = errorsWithoutField.concat(this.errors[i]);
            continue;
        }
        if (this.errors[i] && this.errors[i].length) {
            $errorContainer.html(this.errors[i].join('<br>')).removeClass('hidden');
            $field.parents('.form-group:first').addClass('has-error');
        } else {
            $field.parents('.form-group:first').removeClass('has-error').addClass('has-success');
            $errorContainer.html('').addClass('hidden');
        }
    }

    if (errorsWithoutField.length) {
        alert(errorsWithoutField.join("\n"));
    }
}

Form.prototype.clearForm = function() {
    this.$form.find('.form-group>p').addClass('hidden').html('');
}

Form.prototype.getErrorContainer = function ($field) {
    if ($field.attr('type') == 'checkbox' || $field.attr('type') == 'radio') {
        return $field.parent().next();
    }

    return $field.next('p');
}

Form.prototype.run = function() {
    var result = this.validate();
    this.applyToForm();

    return result;
}
