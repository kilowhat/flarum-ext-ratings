import Component from 'flarum/Component';
import icon from 'flarum/helpers/icon';

export default class Stars extends Component {
    view() {
        return m('.Stars', {
            className: this.props.editable ? 'editable' : '',
        }, [1, 2, 3, 4, 5].map(rating => {
            const active = this.props.value >= rating;

            const isHalf = this.props.value === rating - 0.5;

            return icon(`fa${active || isHalf ? 's' : 'r'} fa-star${isHalf ? '-half-alt' : ''}`, {
                onclick: () => {
                    if (!this.props.editable) {
                        return;
                    }

                    if (this.props.value === rating) {
                        if (rating === 1) {
                            this.props.onchange(null);
                        } else {
                            this.props.onchange(rating - 1);
                        }
                    } else {
                        this.props.onchange(rating);
                    }
                },
            });
        }));
    }
}
