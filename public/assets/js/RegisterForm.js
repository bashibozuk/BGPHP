/**
 * Created by vasil on 9/26/15.
 */
function RegisterForm(config) {
    AjaxForm.call(this,config);
    var _this = this;
    this.$form.on('submit', function(e) {
        e.preventDefault();
        if (!_this.validate()) {
            _this.applyToForm();
        }
    });
    this.validators = {
        'container_code': function (errors, value) {
            if (!value.replace(/^\s+|\s+$/).length) {
                errors.push('This field is required!');
            }
        }
    }
}


RegisterForm.prototype = Object.create(AjaxForm.prototype);
RegisterForm.prototype.constructor = RegisterForm;

RegisterForm.prototype.handleResponse = function(data) {
    console.log(data);
}