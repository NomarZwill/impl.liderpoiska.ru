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

  bind() {
		this.$form.find('[data-required]').each((i, el) => {
			$(el).on('blur', (e) => {
				this.checkField($(e.currentTarget));
				this.checkValid();
			});

			$(el).on('change', (e) => {
			  this.checkValid();
			  // this.checkField($(e.currentTarget));
			});
		});

		this.$form.on('submit', (e) => {
			this.sendIfValid(e);
		});

		this.$form.on('click', 'button.disabled', function(e) {
			e.preventDefault();
			return false;
		});
	}

	checkField($field) {
		var valid = true;
		var name = $field.attr('name');
		var pattern_email = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i;
		var pattern_age = /\d{1,3}/;
		var custom_error = null;

		if ($field.val() == '') {
			valid = false;
			console.log()
		} else {
			if (name === 'phone' && $field.val().indexOf('_') >= 0) {
				valid = false;
				custom_error = 'Неверный формат телефона';
			}

			if (name === 'email' && !(pattern_email.test($field.val()))) {
				valid = false;
				custom_error = 'Неверный формат электронной почты';
			}

			if (name === 'age' && !(pattern_age.test($field.val()))) {
				valid = false;
				custom_error = 'Неверный формат возраста';
			}
		}

		if (valid) {
			$field.removeClass('_invalid');

			if ($field.parent().find('.form_input_error').length > 0)
				$field.parent().find('.form_input_error').html('');

		} else {
			$field.addClass('_invalid');
			var form_error = $field.data('error') || 'Заполните поле';
			var error_message = custom_error || form_error;

			if ($field.siblings('.form_input_error').length === 0) {
				$field.parent('.input_wrapper').append('<div class="form_input_error">' + error_message + '</div>');
			} else {
				$field.siblings('.form_input_error').html(error_message);
			}
		}
	}

	checkValid() {
		this.$submitButton.removeClass('disabled');
		if (this.$form.find('input._invalid').length > 0 || this.$form.find('textarea._invalid').length > 0) {
			this.$submitButton.addClass('disabled');
		}
	}

	checkFields() {
		var valid = true;

    	this.$form.find('[data-required]').each((i, el) => {
			this.checkField($(el));
			if ($(el).hasClass('_invalid'))
				valid = false;
		});

		if (valid) {
			this.$submitButton.removeClass('disabled');
		} else {
			this.$form.find('._invalid')[0].focus();
			this.$submitButton.addClass('disabled');
		}

		return valid;
	}

	reset() {
		this.$form[0].reset();
		// this.$form.find('input').removeClass('form_input_valid form_input_filled');
	}

	success(data, formType) {
		if (this.$form.siblings('._in_content_block').length === 0) {
			this.$form.addClass('_hidden');
		}
		this.$form.siblings('[data-success]').find('[data-success-name]').text(data.name);
		this.$form.siblings('[data-success]').removeClass('_hidden');
	}

	sendIfValid(e) {
		e.preventDefault();
		if (!this.checkFields()) return;
		if (this.disabled) return;

		this.disabled = true;
		// this.beforeSend();

		var formData = new FormData(this.$form[0]);

		var formType = this.$form.data('type');
		formData.append('type', formType);
		var formUrl = window.location.href;
		formData.append('url', formUrl);

		for (var pair of formData.entries()) {
			console.log(pair[0]+ ', ' + pair[1]);
	}

		// fetch(this.to,{
		// method: 'POST',
		// body: formData
		// })
		// .then(status)
		// .then(json)
		// .then(data => {
		// this.success(data, formType);
		// this.reset();
		// this.disabled = false;
		// })
		// .catch(() => {
		// this.error();
		// this.disabled = false;
		// });

		fetch(this.to,{
		method: 'POST',
		body: formData
		})
		.then((response) => {
			return response.json();
		})
		.then((data) => {
			this.success(data, formType);
			this.reset();
			this.disabled = false;
			console.log(data);
		});
}
}