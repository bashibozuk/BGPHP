/**
 * Created by vasil on 9/26/15.
 */
function TrackingForm(config) {
    RegisterForm.call(this,config);

    this.map = new GoogleMaps();
}


TrackingForm.prototype = Object.create(RegisterForm.prototype);
TrackingForm.prototype.constructor = TrackingForm;

TrackingForm.prototype.handleResponse = function(data) {
    console.log(data);
}