class Modals{
    constructor() {
        this.modals = document.querySelectorAll('[data-modal-content]')
        this.arrayModals = Array.from(this.modals)
        this.modalsNames = this.arrayModals.map(list => list.getAttribute('data-modal-content'))
        if(this.isHasDuplicates()){
            throw new Error('Modals "names" have duplicates\n\rPlease change them')
        }

        this.init()
    }
    isHasDuplicates(){
        return this.modalsNames.length !== [...new Set(this.modalsNames)].length
    }
    init(){
        this.modalsNames.forEach(name => {
            const modalContent = document.querySelector(`[data-modal-content="${name}"]`)
            const modalTriggers = document.querySelectorAll(`[data-modal-trigger="${name}"]`)
            Array.from(modalTriggers).forEach(trigger => {
                trigger.addEventListener('click', e => {
                    this.action(modalContent)
                })
            })
        })
    }
    action(content){
        content.classList.toggle('active')
        document.body.classList.toggle('hidden')
    }
}