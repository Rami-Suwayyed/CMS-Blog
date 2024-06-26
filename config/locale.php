<?php

return [

    'status' => true,

    'languages' => [
        /*
         * Key is the Laravel locale code
         * Index 0 of sub-array is the Carbon locale code
         * Index 1 of sub-array is the PHP locale code for setlocale()
         * Index 2 of sub-array is true if the language uses RTL (right-to-left)
         * Index 3 of sub-array is the language name in the original language
         */

        'en' => ['en', 'en_US', false, 'English'],
        'ar' => ['ar', 'ar_JO', true, 'Arabic'],

    ]


];
