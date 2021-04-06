<?php

return [
    /**
     * 管理系统配置
     */

    "device_url"=>'http://weixin.0531yun.cn/',
    "device_token"=>'http://weixin.0531yun.cn/api/getTokenByAcc?loginName=qyx&password=12345',
    "device_getdevice"=>'http://weixin.0531yun.cn/api/device/getDevices',
    "device_realtimedata"=>'http://weixin.0531yun.cn/api/data/getRealtimeData?deviceAddrs=24218374',
    "device_getHistoryData"=>'http://weixin.0531yun.cn/api/data/getHistoryData?devAddr=24218374&termPos=1',

    //商户默认密码
    'default_password' => '123456',

    //腾讯地图key
    'tengxun_key' => 'H76BZ-OHYW6-AR6SW-ELZCW-EZUVJ-6MBI7',

    /**
     * 微信小程序
     */

    // 小程序app_id
    'app_id' => 'wx3c7810c4153f1cdb',
    // 小程序app_secret
    'app_secret' => '999372d30a95cd11e479d4aa7565ec7b',



    /**
     * 支付宝配置
     */
    // 支付宝网关
    'ali_gatewayUrl'               => 'https://openapi.alipay.com/gateway.do',
    //支付宝aooid
    'ali_app_id'                   => '2021001105648153',
    //支付宝公钥
    'ali_alipayrsaPublicKey'       => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAkhhGOzBNuPDhU4gQ89s48MgcLqW7UIniyyxW/1FFI60bylUXAqazThvjRlPEYatiivhR00TeQHSDAZuS4tC/yi7CrQINtxLz32C6RgWFlhWiU4XjiNFNicZGTH7QCZvIWgu20ZdOHKsTHBMyOp4lgpgrsUE2LLT7lUIozbmYJZ4V9bXdEezZEp0psVVCO32Q/hqxCYFhHRXqy+EYmm6uM40Eh+v3d8zJ1YyMooJBvmX3qRtPbMiCE70kMKPPvRSdTe6U5AKqZh+a9jqsKLuw5eaqKhKtwwYRGDgxpnHxPq4EkB6sPx55X6dVOWogRnjiPDfz4BWCozZyTh654vUojQIDAQAB',
    //应用私钥
    'ali_rsaPrivateKey'            => 'MIIEogIBAAKCAQEAjP0kg6chjYwmXUQ+kXb/p2VLhwMg9ujGk3By4p6Qz0ebVdVqobT6fetUogU59V5SLLC9uHXu0PesASnZ4TkalE0ZyXR0G8525jOsy7cTRJtcfAgmLLxbnVqh5jz9Grd+kTAT7+wgcwg29JZj1ZhikxvrrlDdgdcr0ss21B9KJSgPI6CQjN3gKhYH8yvHe4WEu5NV5DDJkazDKpQafUq6gtd6+vYOBBWkbLCcGijFu7TgVcRPS+jbVjL2WPy0rpYw4fitJQOADmoXpcWz23y4EyhRpWOZz+XF4zvkRHn1e2z0pQVrREmpnztcInITXQzA/cOeW/G5uvgG1ZWHLsMaSwIDAQABAoIBACmD+RaTRjwKAtn/2HS5F7rRBxZwg2pxTNfpisrUaku/CCyUNVv8kK43d6pl45Uu+v+R46vHflUmOQ32puO9DuiQc4Fwuyfc+gH7QWyTMidHoEodlDAkHs4M/BNx7g3J7okOITDK1RtKVfRbvHYO8yfiVtnzkeZD1/GwSSrZM9oQql+lg4i1E//5XO2HR02yRTf7WKXg+oGuJJVvEbQG+BRBx/KAXD5eJNYJtHv2M0w0Otx2UuXL/4+dA5j71fohC9MbyWKTX2Z3nVH2PlhQg5rLxK+Oyhz/EMMAxkcXVMy7xE+7qlIh9aO9U7qfuV9GqPgT0fI55h6YfZGeOcKIJ1ECgYEA3xRbtPK6RiKz3o49/hUFYMLxafZOA4PPNK+58tXUFmILluvk/8BTHldk8RjsCIRBUQhdL/CMv7uxkHEgVIPqxsdN0p6mXp8uWzWepm49UYTt+fxewyDP9CVG4IRdm266n4SvAeC1uPuN0gQlPQyl0takH/pQh1T3l2VaVikorN0CgYEAocuCeWgy+vyRMIu9x9lA++fbdaL+Onbrqu1QBKUX3r7zeQcuyZDNLGDt0e47V8F5JMv3ue0jGcctK/zvJaOjdKlbi5AkzhobjncOdDOOrVLVL4cDRxK4kK++E/Z6fG7oY6wNKH8ItQBJIDTOT0iFmN8iHrWGBjekvbsNU8SMvUcCgYA2vpU+065Y1d1USY33E4uNUmnSOiqs/CTWZiV47Xatw4PalqtNBBKhyIqyDA6ojGRHEYlk4WB5EQOjUc/ATdtIytJTVLG5WNEUexUi/Ly5i6inB4Lt2diOrrM1F+as5UCRMwuLp2yRJ9KG7pOA5uCu3BPM8S3f+D8GfU3tBQ7BVQKBgCeiKKYA5mwhLpfLw4OPLqIGm/XnJYvA0d4fH/jjUEOaVx4Qql9p/zidzeQdDaBjnn9rD5YWBwErj181KIf52/KaAfjgKIPsVU/CzmGct5ixr9NiqWThqyCWTGOrfzm4GWlBHkALTmC4XzFqfhdh1ogqMLuBEAG547sudQdOIIPFAoGAAqgiT8tOFzIjf8HQ6oGro0qYCjIM0wc2eXgEjR0gqROha13ce/U+aGgRSXZ1EAEdLtCIbOn4OeFPZTUSGnJmQkO+rNtieMqnni7phqYjDay8LIWkvMMk0kyWGT21H9ZMXoiOFBdIb7Z4ja3u6SDELKG7DDVtJM25vDX6x/0sA6g=',
];