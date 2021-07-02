class MobileMenu {
    constructor() {
        this.triggers = document.querySelectorAll('[data-mobile-menu-trigger]')
        this.content = document.querySelector('[data-mobile-menu-content]')
        if(!this.content) throw new Error(`Selector with attr '[data-mobile-menu-content]' not found`)
        this.status = false
        this.cssClasses = {
            content: {
                active: 'b-mobile-menu_active'
            },
            triggerHeader: {
                active: 'b-header__mobile-menu-trigger_active'
            }
        }

        this.init()
    }

    init() {
        this.listener()
    }

    listener() {
        Array.from(this.triggers).forEach(trigger => {
            trigger.addEventListener('click', () => {
                this.handleClick()
            })
        })
    }

    handleClick() {
        if (this.status) {
            this.close()
        } else {
            this.open()
        }
    }

    open() {
        document.body.style.overflow = 'hidden'
        this.content.classList.add(this.cssClasses.content.active)
        this.status = true

        Array.from(this.triggers).forEach(trigger => {
            trigger.classList.add(this.cssClasses.triggerHeader.active)
        })
    }

    close() {
        document.body.style.overflow = ''
        this.content.classList.remove(this.cssClasses.content.active)
        this.status = false

        Array.from(this.triggers).forEach(trigger => {
            trigger.classList.remove(this.cssClasses.triggerHeader.active)
        })
    }
}