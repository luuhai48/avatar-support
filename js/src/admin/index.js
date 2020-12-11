import AvatarSupportSettingsModal from './AvatarSupportSettingsModal';

app.initializers.add('luuhai48-avatar-support', () => {
    app.extensionSettings['luuhai48-avatar-support'] = () => app.modal.show(AvatarSupportSettingsModal);
});