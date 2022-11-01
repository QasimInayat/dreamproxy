# Setting up local environment

````
php artisan migrate
php artisan db:seed
````

````
INSERT INTO modem (id, server_id, port, apn, ip_type, password, username, imei, modem_id, operator_code, operator_name, device_identifier, revision, model, signal_quality, state, created_at, updated_at) VALUES (1, 1, 'wwan1', '--', '--', '--', '--', '354577095263264', 0, '22250', 'Iliad', 'c8fb7d9f7c968f67a51ef4c5f4fa2eb6593661c9', 'T77W595.F0.0.0.6.6.GC.029', 'HP lt4120 Snapdragon X5 LTE', '51', 'registered', '2022-10-14 21:23:59', '2022-10-18 12:05:38');
INSERT INTO modem (id, server_id, port, apn, ip_type, password, username, imei, modem_id, operator_code, operator_name, device_identifier, revision, model, signal_quality, state, created_at, updated_at) VALUES (2, 1, 'wwan1', '--', '--', '--', '--', '--', 1, '--', '--', 'a56ac2464928a9a3db9c38ea18615cf8fcbda71b', 'T77W595.F0.0.0.6.6.GC.029', 'HP lt4120 Snapdragon X5 LTE', '0', 'failed', '2022-10-14 21:23:59', '2022-10-17 20:20:09');
INSERT INTO modem (id, server_id, port, apn, ip_type, password, username, imei, modem_id, operator_code, operator_name, device_identifier, revision, model, signal_quality, state, created_at, updated_at) VALUES (3, 1, 'wwan0', 'wap.tim.it', 'ipv4v6', '--', '--', '862402050001739', 1, '22201', 'I TIM', '8cc6096b8848408555e99f07dc57b1db7918a490', 'SDX55.LE.1.4.r1-00047-NBOOT.CP', 'SDXPRAIRIE-MTP _SN:D91CAD4E', '12', 'registered', '2022-10-17 17:46:51', '2022-10-18 12:05:38');
INSERT INTO users_modem (id, user_id, modem_id, username, password, comment, expire_date, created_at, updated_at) VALUES (1, 1, 1, 'a', 'b', 'aaaa', '2022-11-21 12:47:35', null, null);
````
