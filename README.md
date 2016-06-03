# ThinkPHP-RESTful API

## 说明

还没有空去研究 ThinkPHP 5，自己写了一个基于 ThinkPHP 3.2 的 API  
支持 table 的增删改查（post, delete, put, get）  
有什么 bug 请通过 issue 或者 pull request 来提交
  
谢谢  

## 使用方法

/api/{$tablename}/{$id}

JavaScript 例子

```javascript
/* 添加文章到数据表 news */
$.ajax({
    url: "/api/news",
    method: "POST",
    data: {"title": "标题", "article":"文章内容"},
    success: function(rsp){ console.log(rsp)}
});

/* 删除数据表 cart 中的物品 */
$.ajax({
    url: "/api/cart",
    method: "DELETE",
    data: {"cart_id": "123", "goods_id":"goods_123"},
    success: function(rsp){ console.log(rsp)}
});

/* 修改数据表 user 中的 nickname */
$.ajax({
    url: "/api/user",
    method: "PUT",
    data: {"user_id": "123", "nickname":"新的昵称"},
    success: function(rsp){ console.log(rsp)}
});

/* 以 快递号(shiping_ref) 作为参考，查询数据表 shipping 中的数据 */
$.ajax({
    url: "/api/shipping",
    method: "GET",
    data: {"shiping_ref": "sr123456"},
    success: function(rsp){ console.log(rsp)}
});

/* 获取查询数据表 news 中最多 100 (默认) 条的数据 */
$.ajax({
    url: "/api/news",
    method: "GET",
    success: function(rsp){ console.log(rsp)}
});

/* 获取查询数据表 news 中最多 200 条的数据 */
$.ajax({
    url: "/api/news?limit=200",
    method: "GET",
    success: function(rsp){ console.log(rsp)}
});

/* 通过 url 以 物品编号(goods_id) 作为参考，查询数据表 goods 中的数据 */
$.ajax({
    url: "/api/goods/123",
    success: function(rsp){ console.log(rsp)}
});
```

## 联系作者

邮箱 weijingjaylin@gmail.com

## 版权声明

MIT，署名，商业友好，自由更改。
