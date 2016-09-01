<?php if (!class_exists('CaptchaConfiguration')) { return; }

// BotDetect PHP Captcha configuration options

return [
  // Captcha configuration for login page
  'LoginCaptcha' => [
    'UserInputID' => 'CaptchaCode',
    'CodeLength' => CaptchaRandomization::GetRandomCodeLength(5, 6),
  	'HelpLinkEnabled' => false,
  	'ImageWidth' => 170,
    'ImageStyle' => [
      ImageStyle::Radar,
      ImageStyle::Collage,
      ImageStyle::Fingerprints,
    ]
  ],
  
  // Captcha configuration for register page
  'RegisterCaptcha' => [
    'UserInputID' => 'CaptchaCode',
    'CodeLength' => CaptchaRandomization::GetRandomCodeLength(5, 6),
    'CodeStyle' => CodeStyle::Alpha,
  	'HelpLinkEnabled' => false,
  	'ImageWidth' => 170,
    //'CustomLightColor' => '#9966FF',
  	'ImageStyle' => [
		ImageStyle::Radar,
  		ImageStyle::Collage,
  		ImageStyle::Fingerprints,
  	]
  ],
  
];
?>