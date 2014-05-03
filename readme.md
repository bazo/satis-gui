Satis GUI
=======================

Installation

    composer create-project bazo/satis-gui

then run

    cli app:install

create a user

    cli user:create name password

login, add packages through gui

build packages.json

    cli satis:build

or click the Build button
or use webhooks


To customize the app create file app/config/config.local.neon

Parameters you might want to change:

    parameters:
        satis:
            name: A Composer Repository
            require-all: true

        webhook:
            password: webhookpassword

Any other options for satis are suported too, just the provide the right structure under the satis key