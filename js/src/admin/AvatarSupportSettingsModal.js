import SettingsModal from 'flarum/components/SettingsModal';

export default class AvatarSupportSettingsModal extends SettingsModal {
    className() {
        return 'Modal--small';
    }

    title() {
        return app.translator.trans('luuhai48-avatar-support.admin.settings.title');
    }

    form() {
        return [
            <div className="Form-group">
                <label>{app.translator.trans('luuhai48-avatar-support.admin.settings.processor_url')}</label>
                <input className="FormControl" type="url" bidi={this.setting('luuhai48-avatar-support.processor_url')}/>
            </div>,
        ];
    }
}