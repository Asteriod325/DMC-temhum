<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


/**
 * 首页轮播图
 */
//轮播图
Route::get('api/:version/banner','api/:version.Banner/getBanner');


//用户地址
//获取用户地址
Route::get('api/:version/address/get','api/:version.Address/getAddress');
//设置用户地址
Route::post('api/:version/address/set','api/:version.Address/setAddress');
//编辑用户地址
Route::post('api/:version/address/edit','api/:version.Address/edittAddress');


/**
 * 分类标签
 */
//获取所有的分类
Route::get('api/:version/category', 'api/:version.Category/getAllCategories');
//获取单个分类下的商家
Route::get('api/:version/category/:shop_id', 'api/:version.Category/getShopByCategory');


/**
 * 评论
 */
//存入评论的信�?
Route::post('api/:version/comment', "api/:version.Comment/setComment");
//根据商家ID获取商家下的评论
Route::get('api/:version/comment/:shop_id', "api/:version.Comment/getComment");



//支付宝获取code
Route::post('api/:version/getcodeali','api/:version.Login/getCodeAli');
//支付宝存入信息
Route::post('api/:version/setuserinfoali','api/:version.Login/setUserInfoAli');



/**
 * 商家
 */
//获取商家的列表，根据热度来排�?
Route::get('api/:version/shop/recent', 'api/:version.Shop/getRecent');
//获取单个商家的详�?
Route::get('api/:version/shop/:shop_id', 'api/:version.Shop/getOne');

Route::get('api/:version/shopimage/:shop_id', 'api/:version.Shop/getImage');

/**
 * 分类标签
 */
//获取分类的相关数�?
Route::get('api/:version/category', 'api/:version.Category/getAllCategories');
//获取单个分类下的商家
Route::get('api/:version/category/:id', 'api/:version.Category/getShopByCategory');

/**
 * 预定
 */
//存入预定的信�?
Route::post('api/:version/reserve', 'api/:version.Reserve/setReserve');
//获取用户的预�?
Route::get('api/:version/reserve/get', 'api/:version.Reserve/getReserve');


/**
 * 图片
 */
//上传评论
Route::post('api/:version/upload', 'api/:version.Upload/setCommentImg');




/**
 * 商家自定义
 */
//获取商家自定义
Route::get('api/:version/mine/:shop_id', 'api/:version.Mine/getMineNow');




/**
 * 登录
 */
//微信登录
Route::post('api/:version/token/user', 'api/:version.Token/getToken');
//验证微信信息
Route::post('api/:version/token/verify', 'api/:version.Token/verify');

/**
 * 订单
 */
//下单
Route::post('api/:version/order', 'api/:version.Order/placeOrder');
//获取用户的的订单信息
Route::get('api/:version/order/by_user', 'api/:version.Order/getSummaryByUser');
//获取订单的详�?
Route::get('api/:version/order/:id', 'api/:version.Order/getDetail');


/**
 * 支付
 */
//预订�?
Route::post('api/:version/pay/pre_order', 'api/:version.Pay/getPreOrder');
//支付回调
Route::post('api/:version/pay/re_notify', 'api/:version.Pay/receiveNotify');

Route::get('api/:version/query/getquery/:id', 'api/:version.Query/queryOrder');

/**
 * 单独退款接�?
 */
//退款接�?
Route::post('api/:version/refund', 'api/:version.Refund/getRefund');
Route::get('api/:version/refund/byuser', 'api/:version.Refund/getRefundByUser');

/**
 * 用户
 */
//存入用户的信�?
Route::post('api/:version/setuser', 'api/:version.User/setUser');
Route::get('api/:version/setguser', 'api/:version.User/setGUser');

/**
 * 生产二维�?
 */
//二维码接�?
Route::get('api/:version/wxcode/factivity/:shop_id', 'api/:version.Wxcode/factivityCode');
Route::get('api/:version/wxcode/shop/:shop_id', 'api/:version.Wxcode/shopCode');
Route::get('api/:version/wxcode/pay/:shop_id', 'api/:version.Wxcode/payCode');


/**
 * 搜索
 */
//搜索获取商家列表
Route::post('api/:version/search', 'api/:version.Search/search');



//分享卡券
Route::get('api/:version/sharecode/:coupon_id', 'api/:version.Wxcode/shareCode');

/**
 * 优惠券
 */
//获取优惠券
Route::post('api/:version/coupon/get', 'api/:version.Coupon/getCoupon');
//查看用户的优惠券
Route::get('api/:version/coupon/getbyuser', 'api/:version.Coupon/getCouponByUser');
//判断用户在当前商家是否有优惠券
Route::get('api/:version/coupon/iscoupon/:shop_id', 'api/:version.Coupon/isCoupon');
//分享转移优惠券
Route::get('api/:version/coupon/share/:coupon_id', 'api/:version.Coupon/shareCoupon');
//抵扣优惠券
Route::get('api/:version/coupon/use/:coupon_id', 'api/:version.Coupon/revision');
//优惠券过期提醒
Route::get('api/:version/coupon/message', 'api/:version.Coupon/message');
//优惠券规则
Route::get('api/:version/coupon/getbywx/:shop_id', 'api/:version.Coupon/getCouponWx');

/**
 * 模版消息
 */
Route::get('api/:version/message', 'api/:version.Message/getMessage');


//抽奖
Route::get('api/:version/draw/:shop_id', 'api/:version.Draw/getDraw');
//领奖
Route::get('api/:version/draw/:shop_id', 'api/:version.Draw/setDraw');


//获取外卖信息
Route::get('api/:version/Takeout/gettakeout/:shop_id', 'api/:version.Takeout/getDraw');
//创建外卖订单
Route::post('api/:version/Takeout/settakeout', 'api/:version.Takeout/setDraw');
//查看外卖订单
Route::get('api/:version/Takeout/setbyuser', 'api/:version.Takeout/setDraw');


