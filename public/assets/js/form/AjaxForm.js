/**
 * Created by vasil on 8/26/15.
 */

function AjaxForm(config) {
    this.onSuccess = typeof config.onSuccess == 'function' ? config.onSuccess : function(){};
    this.onError = typeof config.onError == 'function' ? config.onError : function(){};
    this.dataType = config.dataType ? config.dataType : 'json';

    Form.call(this, config);
}

AjaxForm.prototype = Object.create(Form.prototype);
AjaxForm.prototype.constructor = AjaxForm;

AjaxForm.prototype.getRequestDataFromForm = function() {
    var result = {
        method : this.$form.attr('method') ? this.$form.attr('method').toLowerCase() : 'post',
        url: this.$form.attr('data-action') ? this.$form.attr('data-action'): this.$form.attr('action')? this.$form.attr('action') : window.location.href

    }

    return result;
}

AjaxForm.prototype.send = function() {
    if (this.run()) {
        var requestData = this.getRequestDataFromForm();
        return $.ajax({
            url:requestData.url,
            method: requestData.method,
            data: this.collectData(),
            dataType: this.dataType
        })
    }
}

AjaxForm.prototype.collectData = function() {
    var data = {};
    var _this = this;
    $('input, textarea, select', this.$form).each(function(){
        if (this.tagName.toLowerCase() == 'input' && (this.type == 'checkbox' || this.type == 'radio') && !this.checked) {
            return;
        }

        _this.dataForName(this.value, this.name, data);
    });

    return data;
}

AjaxForm.prototype.dataForName = function (data, name, dataContainer) {
    name = name.replace(/\]/g, '').split('[');
    if (name.length > 1) {
        var key =  name.splice(0, 1);
        if (!dataContainer[key]) {
            dataContainer[key] = {};
        }
        this.dataForName(data, name.join('['), dataContainer[key])
    } else {
        dataContainer[name] = data;
    }
}

AjaxForm.prototype.handleResponse = function (data) {

    if (data.status == 'OK') {
        if (data.message) {
            alert(data.message);
        }
        return true;
    } else  if (data.errors) {
        this.clearForm();
        this.errors = data.errors;
        this.applyToForm();
        return false;

    } else {
        alert(data.message ? data.message : 'You message was not sent due to technical reasons. Please, try again later!');
        return false;
    }
}

AjaxForm.prototype.handleError = function () {
    alert('Error');
}