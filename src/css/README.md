CSS
===



# css选择器

css3选择器基础:

- `*{}`  针对所有元素
- `.name:after{} ` 伪类,在这个元素前
- `.name:before{}`   伪类,在这个元素后, `{display:table;content:""}` 用来解决div的高度不能被内部的元素撑大的问题.
- `.name`    创建类, 对应 `class="name"`
- `li`   标签选择器, 对应`< li >`
- `.name *{}`    针对`class="name"`对象内部的所有元素
- `#div1`    id选择器, 对应 `id="div1"`
- `.name.demo{}` 中间无都好分隔, 对应 `class="name demo"` 同时应用了2个类的对象会生效
- `.name,.demo{}` 只是设置2个类相同的css属性
- `.name > div{}`  只选择.name元素的下一级的子元素. 不是所有的div,不包括孙子元素
- `div+p{}` 每个div后面紧跟着的第一个p元素, 设定样式, 不是所有的p
- `div~p{}` 选择div后面所有的同级p元素.


### 选择符

元素选择符：

- css1 ： `E{}， E#id{}, E.class{} `
- css2 ： `*{} `

属性选择符：（针对标签元素）

- 标签设置了指定属性 `E[att]`
-  属性值等于某个值 `E[att="val"]`
- 属性值包含某个值，值需要用空格分割，例如 class可以用空格分割多个值 `E[att~="val"]`
- 属性的值以某个字符串开头 `E[att^="val"]`
- 属性的值以某个字符串结尾 `E[att$="val"]`
- 属性值包含某个值`E[att*="val"]`
- 属性值以某个字符串开头，但多匹配一个带`-`， `E[att|="val"]`, 即匹配以`val` 和 `val-`开头

关系选择符

- `E F` 包含选择符： 选择所有被E元素包含的F元素， 写法`.demo div{}` - css1
  - `class="demo"` 元素下的所有 div标签都会被应用样式 ,例如都加上了边框。
- `E>F` 子元素符: 选择所有作为E元素的子元素F，写法`.demo div{}` - css2
  - class="demo" 元素下一级的div标签被选择，但下一级div中的div子子元素不会被选择。
  - 只选择自身一下级的 子元素。子元素内部不会进行匹配，不会贪婪匹配
- `E+F` 相邻选择符： 选择紧贴在E元素之后F元素， 写法`p+p {}` - css2
  - 给相邻紧挨在一起的第二个P元素应用样式
- E~F 兄弟选择符： 选择E元素后面的所有兄弟元素F。写法`p~p{}` - css3
  - 会命中所有符合条件的兄弟元素，而不强制是紧邻的元素。
  - 除了E元素本身不会被应用样式

伪类选择符`IE9+`

- `E:link` : 访问前
- `E:visited` ： 已被访问过时的样式
- `E:hover` ： 鼠标悬停时的样式
- `E:active` ：在鼠标点击与释放之间发生的事件
- `E:focus` ：成为输入焦点（该对象的onfocus事件发生）时的样式
- `E:lang(fr)` ： 匹配使用特殊语言的E元素
- `E:not(s)` ：匹配不含有s选择符的元素E。
	- `E:not(:last-child)` ：除最后一项外的所有项加一条底边线
- `E:root` : 匹配E元素在文档的根元素。在HTML中，根元素永远是HTML
- `E:first-child` : 匹配父元素的第一个子元素E。
	- 选择第一个li元素，写成`li:first-child` 而不是`ul:first-child`
- `E:last-child` : 匹配父元素的最后一个子元素E,E必须是父元素的最后一个子元素
- `E :target` : 选择当前活动的#news元素（包含该锚名称的点击的URL）, 冒号之前必须右空格



#### 超链接状态顺序

没有按照一致的书写顺序，不同的浏览器可能会有不同的表现

 * a:link {}
 * a:visited {}
 * a:hover {}
 * a:active {}



> 注意：IE6不支持css2的选择器，从IE7开始支持



### css2 选择器

`body` 下子元素 `class="mian"` 的div 元素 内的 第五个`span` 标签元素.

```css
Body > .main div > span[5] {...}
```

### css3 选择器

```css
Body > .main tbody:nth-child(even){...}
Body > .main tr:nth-child(odd){...)
:not(.textinput){...}
div:first-child{...}
```

- `tbody: nth-child(even), nth-child(odd)`：此处他们分别代表了表格（tbody）下面的偶数行和奇数行（tr），这种样式非常适用于表格，让人能非常清楚的看到表格的行与行之间的差别，让用户易于浏览。
- `:not(.textinput)`：这里即表示所有 class 不是“textinput”的节点。
- `div:first-child`：这里表示所有 div 节点下面的第一个直接子节点。

除此之外，还有很多新添加的选择器：

```
E:nth-last-child(n)
E:nth-of-type(n)
E:nth-last-of-type(n)
E:last-child
E:first-of-type
E:only-child
E:only-of-type
E:empty
E:checked
E:enabled
E:disabled
E::selection
E:not(s)
```

