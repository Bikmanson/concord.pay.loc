class MobileMenuDropdown {
    constructor() {
        this.place = document.querySelector('.b-mobile-menu__list')
        this.triggers = this.place.querySelectorAll('ul > li > i')
        this.contents = this.place.querySelectorAll('ul > li > ul')
        if(
            this.triggers.length !==
            this.contents.length
        ) throw new Error('Triggers length and contents length not equal')

        this.cssClasses = {
            trigger: {
                active: 'active'
            },
            content: {
                active: 'active'
            }
        }

        this.init()
    }

    init(){
        this.listeners()
    }

    listeners(){
        Array.from(this.triggers).forEach((trigger, index) => {
            trigger.addEventListener('click', () => {
                this.handleClick(index)
            })
        })
    }

    handleClick(index){
        this.toggle(index)
    }

    toggle(index){
        this.triggers[index].classList.toggle(this.cssClasses.trigger.active)
        this.contents[index].classList.toggle(this.cssClasses.content.active)
    }
}