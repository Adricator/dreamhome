document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.property-card');
            if (cards.length <= 1) return; 

            let activeIndex = 0;

            function updateSliderView(nextIndex, direction = 'next') {
                const currentCard = cards[activeIndex];
                const nextCard = cards[nextIndex];

                currentCard.classList.remove('card-active');
                
                if (direction === 'next') {
                    currentCard.classList.add('card-hidden-left');
                    nextCard.classList.remove('card-hidden-left');
                } else {
                    currentCard.classList.add('card-hidden-right');
                    nextCard.classList.remove('card-hidden-right');
                }

                nextCard.classList.remove('card-hidden-right', 'card-hidden-left');
                nextCard.classList.add('card-active');

                activeIndex = nextIndex;
            }

            document.getElementById('prev-property-btn').addEventListener('click', () => {
                let targetIdx = activeIndex - 1 < 0 ? cards.length - 1 : activeIndex - 1;
                updateSliderView(targetIdx, 'prev');
            });

            document.getElementById('next-property-btn').addEventListener('click', () => {
                let targetIdx = activeIndex + 1 >= cards.length ? 0 : activeIndex + 1;
                updateSliderView(targetIdx, 'next');
            });

            cards[0].classList.remove('card-hidden-right', 'card-hidden-left');
            cards[0].classList.add('card-active');
        });