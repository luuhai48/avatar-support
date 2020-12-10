import { override } from 'flarum/extend';
import AvatarEditor from 'flarum/components/AvatarEditor';

app.initializers.add('luuhai48/avatar-support', () => {
    override(
        AvatarEditor.prototype, 'openPicker', function () {
            if (this.loading) return;

            const $input = $('<input type="file" accept=".jpg,.jpeg,.jpe,.png,.gif,.bmp,.dib,.heic,.heif">');

            $input
                .appendTo('body')
                .hide()
                .click()
                .on('input', (e) => {
                    let file = e.target.files[0];
                    if (file.type === "image/heif") {

                    } else {
                        this.upload(file);
                    }
                });
        }
    );
});
