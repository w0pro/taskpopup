jQuery(function($) {

    class PopUp {
        constructor(name) {
            this.nameNode = document.querySelector(`${name}`)
            this.popUpContentId = this.nameNode.dataset.src
            this.popUpContent = document.querySelector(`${this.popUpContentId}`)
           this.addListener()
        }
        addListener() {
            this.nameNode.addEventListener('click', () => {
                let newPopUpContent = this.popUpContent
                this.createPopUp(newPopUpContent)
            })
        }

        createPopUp(data) {
            console.log(data)
            document.body.classList.add('custom__pop');
            const popUpOverlay = document.createElement('div');
                popUpOverlay.classList.add('pop-up__overlay');
                document.body.append(popUpOverlay)
            const popUpWrapper = document.createElement('div');
                popUpWrapper.classList.add('pop-up_wrapper')
            popUpOverlay.append(popUpWrapper)

            popUpWrapper.insertAdjacentElement('afterbegin', data)
            const popUpCloseBtn = document.createElement('div')
            popUpCloseBtn.classList.add('close-btn')
            popUpCloseBtn.innerHTML = '<div class="close__button_wrapper"><span></span><span></span></div>'
            popUpWrapper.append(popUpCloseBtn)
            popUpCloseBtn.addEventListener('click', () => {
                this.closePopUp(popUpOverlay)
            })
            data.classList.add('active-active')
        }

        closePopUp (data) {
            data.remove();
            document.body.classList.remove('custom__pop');
        }
    }


    class Form extends PopUp {
       constructor(name, formId) {
           super(name);
           this.form = document.querySelector(`${formId}`);
           this.formButtonSubmit = this.form.querySelector('.form__submit_button');
           this.action = this.form.getAttribute('action')
           this.submit();
          this.fieldsHandler()
       }
       fieldsHandler() {

           const formFields = this.form.querySelectorAll('.input__content');
           console.log(formFields)
           formFields.forEach((el, index) => {
               let itemClick =  el.querySelector('[class*="form"]')
               itemClick.addEventListener('input', (event) => {
                   itemClick.classList.remove('error')
               })
           })
       }

       responseHandlers(res) {
           if (res.success) {
               alert('Спасибо! Сообщение отправлено')
           } else {
               res.data.forEach((el) => {
                   this.form.querySelector(`.form__${el}`).classList.add('error')
               })
           }

       }

       submit() {
           this.formButtonSubmit.addEventListener('click', () => {
               this.sendMail(this.form, this.action)
                   .then(res=> this.responseHandlers(res))
           })
       }

       async sendMail (form, action) {
           let objectForm = await new FormData(form)
           objectForm.append('action', action);
           objectForm.append('nonce', feedback_object.nonce);
           let response = await fetch( feedback_object.url, {
               method: 'POST',
               body: objectForm,
           })
           let result = await response.json();
           return result;
       }
    }

    let popUp = new Form('#pop__up__btn', '#form__feedback')

})
