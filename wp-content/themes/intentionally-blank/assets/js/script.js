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
            document.body.classList.add('custom__pop');
            const popUpOverlay = document.createElement('div');
                popUpOverlay.classList.add('pop-up__overlay');
                document.body.append(popUpOverlay)
            const popUpWrapper = document.createElement('div');
                popUpWrapper.classList.add('popUpWrapper')
            popUpOverlay.append(popUpWrapper)
            popUpWrapper.insertAdjacentElement('afterbegin', data)
            data.classList.add('active-active')
        }




    }

    let popUp = new PopUp('#pop_up_btn')




})
