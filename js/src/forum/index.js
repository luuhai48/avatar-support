import { override } from 'flarum/extend';
import AvatarEditor from 'flarum/components/AvatarEditor';
import heic2any from 'heic2any';

app.initializers.add('luuhai48/avatar-support', () => {
    override(
        AvatarEditor.prototype, 'openPicker', function() {
            if (this.loading) return;

            const $input = $('<input type="file">');

            $input
                .appendTo('body')
                .hide()
                .click()
                .on('input', (e) => {
                    let file = e.target.files[0];
                    if (file.type === "image/heif") {
                        let blob = new Blob([file], { type: file.type});
                        heic2any({
                            blob,
                            toType: "image/png",
                        }).then(conversion => {
                            this.upload(conversion);
                        })
                    } else {
                        this.upload(file);
                    }
                });
        }
    );
});
