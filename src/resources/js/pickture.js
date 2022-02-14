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
                        if (option.dataset.bleed) {
                            option.closest('.ni_block, .matrixblock')
                                .style.background = option.dataset.bleed
                        } else {
                            option.closest('.ni_block, .matrixblock')
                                .style.background = ''
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


                            // bleed if already selected
                            if (input.checked && option.dataset.bleed) {
                                option.closest('.ni_block, .matrixblock')
                                    .style.background = option.dataset.bleed
                            }
                        })
                })
        },
    });
})(jQuery);
