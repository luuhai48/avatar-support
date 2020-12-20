import { override } from 'flarum/extend';
import AvatarEditor from 'flarum/components/AvatarEditor';
import mime from 'mime';

app.initializers.add('luuhai48/avatar-support', () => {
    override(
        AvatarEditor.prototype, 'openPicker', function () {
            if (this.loading) return;
            const user = this.attrs.user;

            const $input = $('<input type="file" accept="image/jpeg,image/png,image/gif,image/bmp,.heic,.heif">');

            $input
                .appendTo('body')
                .hide()
                .click()
                .on('input', (e) => {
                    if (this.loading) return;

                    let file = e.target.files[0],
                        fileMime = mime.getType(file.name);
                    
                    if (fileMime === "image/heic" || fileMime === "image/heif") {
                        const data = new FormData();
                        data.append('img', file);

                        this.loading = true;
                        m.redraw();

                        app
                            .request({
                                method: 'POST',
                                url: `${app.forum.attribute('apiUrl')}/users/${user.id()}/avatar-support`,
                                serialize: (raw) => raw,
                                body: data,
                            })
                            .then(this.success.bind(this), this.failure.bind(this));
                    } else {
                        this.upload(file);
                    }
                });
        }
    );
});
