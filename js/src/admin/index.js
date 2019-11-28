import app from 'flarum/app';
import {extend} from 'flarum/extend';
import PermissionGrid from 'flarum/components/PermissionGrid'

app.initializers.add('kilowhat/flarum-ext-ratings', () => {
    extend(PermissionGrid.prototype, 'viewItems', function (items) {
        items.add('kilowhat-ratings', {
            icon: 'fas fa-star-half-alt',
            label: app.translator.trans('kilowhat-ratings.admin.permissions.view'),
            permission: 'kilowhatRatings.view',
            allowGuest: true,
        });
    });

    extend(PermissionGrid.prototype, 'replyItems', function (items) {
        items.add('kilowhat-ratings', {
            icon: 'fas fa-star-half-alt',
            label: app.translator.trans('kilowhat-ratings.admin.permissions.submit'),
            permission: 'kilowhatRatings.submit',
        });
    });

    extend(PermissionGrid.prototype, 'moderateItems', function (items) {
        items.add('kilowhat-ratings', {
            icon: 'fas fa-star-half-alt',
            label: app.translator.trans('kilowhat-ratings.admin.permissions.moderate'),
            permission: 'kilowhatRatings.moderate',
        });
    });
});
