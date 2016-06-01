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
$.ajax({
    method: "POST",
    data: {"article":"文章内容"},
    success: function(rsp){ console.log(rsp)}
})
```

## 联系作者

邮箱 weijingjaylin@gmail.com

## 版权声明

MIT，署名，商业友好，自由更改。