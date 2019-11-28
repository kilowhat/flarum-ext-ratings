import app from 'flarum/app';
import {extend} from 'flarum/extend';
import ReplyComposer from 'flarum/components/ReplyComposer';
import EditPostComposer from 'flarum/components/EditPostComposer';
import CommentPost from 'flarum/components/CommentPost';
import DiscussionHero from 'flarum/components/DiscussionHero';
import Stars from './components/Stars';

app.initializers.add('kilowhat/flarum-ext-ratings', () => {
    extend(ReplyComposer.prototype, 'init', function () {
        this.kilowhatRating = null;
    });

    extend(ReplyComposer.prototype, 'headerItems', function (items) {
        if (app.forum.attribute('kilowhatRatingCanSubmit')) {
            items.add('kilowhat-ratings', Stars.component({
                value: this.kilowhatRating,
                onchange: value => {
                    this.kilowhatRating = value;
                },
                editable: true,
            }));
        }
    });

    extend(ReplyComposer.prototype, 'data', function (data) {
        if (app.forum.attribute('kilowhatRatingCanSubmit')) {
            data.kilowhatRating = this.kilowhatRating;
        }
    });

    extend(EditPostComposer.prototype, 'init', function () {
        this.kilowhatRating = this.props.post.attribute('kilowhatRating');
    });

    extend(EditPostComposer.prototype, 'headerItems', function (items) {
        if (this.props.post.attribute('kilowhatRatingCanEdit')) {
            items.add('kilowhat-ratings', Stars.component({
                value: this.kilowhatRating,
                onchange: value => {
                    this.kilowhatRating = value;
                },
                editable: true,
            }));
        }
    });

    extend(EditPostComposer.prototype, 'data', function (data) {
        if (this.props.post.attribute('kilowhatRatingCanEdit')) {
            data.kilowhatRating = this.kilowhatRating;
        }
    });

    extend(CommentPost.prototype, 'headerItems', function (items) {
        const rating = this.props.post.attribute('kilowhatRating');

        if (rating) {
            items.add('kilowhat-ratings', Stars.component({
                value: rating,
            }));
        }
    });

    extend(DiscussionHero.prototype, 'items', function (items) {
        const rating = this.props.discussion.attribute('kilowhatRating');

        if (rating) {
            items.add('kilowhat-ratings', Stars.component({
                value: rating,
            }));
        }
    });
});
