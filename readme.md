
TODO :

  - http://bedrock-test1.local/wp/home/sbeasley/Sites/bedrock-test1/vendor/WebDevStudiosXXX/CMB2/css/cmb2.css?ver=4.4.1
  - http://bedrock-test1.local/app/plugins/medusa-content-suite/vendor/WebDevStudiosXXX/CMB2/css/cmb2.css?ver=4.4.1
  - make compatible with multi-site
  - WebDevStudiosXXX needs changing - look at package type priorities in composer
  - global variables need - DRY - packageVendorPath and any other common vars
  - sort out constructors
  - config tests - error notices
    - check all metabox ids are unique!
  - Linkage class for vendordir and package dirs, calling new Checker class with config tests
  - cmb2 field types config needs moving or automating
  - add bootstrap ! check integration with cmb2 grid - probably not needed
  - php validation needed - zend, respect validation, yii ?? 
    - tpl needed for 
  - prevent direct file access
  - fix yaml functions
  - flush_rewrite_rules(); on pt registration - http://solislab.com/blog/plugin-activation-checklist/