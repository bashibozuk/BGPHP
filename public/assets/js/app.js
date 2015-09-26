/**
 * Created by vasil on 9/26/15.
 */
$(function(){
    var registerForm = new RegisterForm({
        form: $('#register-form')
    })

    var trackingForm = new TrackingForm({
        form: $('#tracking-form')
    })

    new App($('nav'));
});

function App($menu) {
    this.$menu = $menu;
    this.init();
    this.onMenuClick({});
}

App.prototype.init = function () {
    var _this = this;
    this.$menu.find('a').on('click', function(e) {
        e.preventDefault();
        _this.onMenuClick(this);
    });
}

App.prototype.onMenuClick = function (link) {
    $('.site-panel').hide('fast', function() {
        var $el = $($(link).attr('href'));

        if ($el.length) {
            $el.show();

        } else {
            $('#index').show();
        }
    });


}