(function($){
    PicktureField = Garnish.Base.extend({
        initialized: false,

        init: function() {
            if (!this.initalized) {
                this.initalized = true
                this.initialize()
            }
        },


        initialize: function() {
            document.querySelectorAll('.pickture-group')
                .forEach(group => {

                    const groupOptions = group.querySelectorAll('.pickture-option')
                    const select = option => {
                        const input = option.querySelector('input[type=radio]')
                        input.checked = true

                        // set the active class
                        option.classList.add('active')
                        groupOptions
                            .forEach(opt => {
                                if (opt != option) {
                                    opt.classList.remove('active')
                                }
                            })

                        // bleed if set
                        const parent = option.closest('.ni_block, .matrixblock, .content-pane')
                        if (option.dataset.bleed && parent) {
                            parent.style.background = option.dataset.bleed
                        } else {
                            parent.style.background = ''
                        }

                    }

                    groupOptions
                        .forEach(option => {
                            option.addEventListener('click', () => {
                                select(option)
                            })

                            const input = option.querySelector('input[type=radio]')
                            input.addEventListener('change', () => {
                                    select(option)
                                })


                            if (input.checked) {
                                option.classList.add('active')

                                // bleed if already selected
                                const parent = option.closest('.ni_block, .matrixblock, .content-pane')
                                if (option.dataset.bleed && parent) {
                                    parent.style.background = option.dataset.bleed
                                }
                            }

                        })
                })
        },
    });
})(jQuery);
