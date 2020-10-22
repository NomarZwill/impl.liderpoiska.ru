import Inputmask from 'inputmask';

export default class Form {
	constructor(form) {
		this.$form = $(form);
		this.$submitButton = this.$form.find('button[type="submit"]');
		this.$policy = this.$form.find('[name="policy"]');
		this.to = (this.$form.attr('action') == undefined || this.$form.attr('action') == '') ? this.to : this.$form.attr('action');
		var im_phone = new Inputmask('+7 (999) 999-99-99', {
      clearIncomplete: true,
      showMaskOnHover: false,
	  });
    im_phone.mask($(this.$form).find('[name="phone"]'));
    
		this.bind();
  }

  bind() {}
}