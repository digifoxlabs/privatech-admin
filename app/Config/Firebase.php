<?php

namespace Config;

class Firebase
{
    public static function getFirebaseConfig()
    {
        return [
            'keyFilePath' => base_url('public/rts-security-fa478-firebase-adminsdk-88nor-c562f65ffc.json'),
            'projectId' => 'rts-security-fa478',
        ];
    }
}

?>
