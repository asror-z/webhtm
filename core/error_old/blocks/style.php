<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap@4.14.1/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdbootstrap@4.14.0/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css">-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css">
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/v4-shims.min.css">-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/v4-shims.min.css">

<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css">-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css">
<!--
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="/render/asrorz/mdb/css/mdb.min.css">

<style type="text/css">
    /* reset */
    html,
    body,
    div,
    span,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    pre,
    a,
    code,
    em,
    img,
    strong,
    b,
    i,
    ul,
    li {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }

    body {
        line-height: 1;
        background-image: url("https://s1.1zoom.ru/b6259/712/Sky_Clouds_From_above_533131_1920x1080.jpg");
        background-size: cover;
    }

    ul {
        list-style: none;
    }

    /* base */
    a {
        text-decoration: none;
        color: #e51717;

    }

    a:hover {
        text-decoration: underline;
    }

    h1,
    h2,
    h3,
    p,
    img,
    ul li {
        font-family: Arial, sans-serif;
        color: #505050;
    }

    /*corresponds to min-width of 860px for some elements (.header .footer .element ...)*/
    @media screen and (min-width: 960px) {

        html,
        body {
            overflow-x: hidden;
        }
    }

    /* header */
    .header {
        /* min-width: 860px; */
        width: 100%;
        /* 960px-50px * 2 */
        margin: 0 auto;
        background: #f3f3f3;
        padding: 20px 50px;
        border-bottom: #ccc 1px solid;
    }

    .header h1 {
        font-size: 30px;
        color: #e57373;
    }


    .header h3 span,
    .header h3 span a {
        color: #e51717;
    }

    .header h1 a {
        color: #e57373;
    }

    .header h3 a:hover {
        color: #e51717;
    }

    .header img.erroricon {
        float: right;
        margin-top: -15px;
        margin-left: 50px;
    }

    .header .tools {
        float: right;
    }

    .header .tools a {
        border-radius: 5px;
        width: 25px;
        text-align: center;
        margin-right: 7px;
    }

    .header .tools a:first-child {
        border-radius: 5px;
        width: auto;
        text-align: center;
        margin-right: 7px;
    }

    .header .tools a,
    .header .tools span {
        display: block;
        float: left;
        height: 25px;
        padding: 5px;
    }

    .header .tools span {
        display: none;
    }

    .header .tools a{
        color: #e51717;
    }

    .header .tools a:hover {
        text-decoration: none;
    }

    .header .tools a:active img {
        position: relative;
        left: 2px;
        top: 2px;
    }

    .header .tools textarea {
        position: absolute;
        top: -500px;
        right: 300px;
        width: 750px;
        height: 150px;
    }

    .header h2 {
        font-size: 20px;
        line-height: 1.25;
    }

    .header pre {
        margin: 10px 0;
        overflow-y: scroll;
        font-family: Courier, monospace;
        font-size: 14px;
    }

    /* previous exceptions */
    .header .previous {
        margin: 20px 0;
        padding-left: 30px;
    }

    .header .previous div {
        margin: 20px 0;
    }

    .header .previous .arrow {
        -moz-transform: scale(-1, 1);
        -webkit-transform: scale(-1, 1);
        -o-transform: scale(-1, 1);
        transform: scale(-1, 1);
        filter: progid:DXImageTransform.Microsoft.BasicImage(mirror=1);
        font-size: 26px;
        position: absolute;
        margin-top: -3px;
        margin-left: -30px;
        color: #e51717;
    }

    .header .previous h2 {
        font-size: 20px;
        color: #e57373;
        margin-bottom: 10px;
    }

    .header .previous h2 span {
        color: #e51717;
    }

    .header .previous h2 a {
        color: #e57373;
    }

    .header .previous h2 a:hover {
        color: #e51717;
    }

    .header .previous h3 {
        font-size: 14px;
        margin: 10px 0;
    }

    .header .previous p {
        font-size: 14px;
        color: #aaa;
    }

    .header .previous pre {
        font-family: Courier, monospace;
        font-size: 14px;
        margin: 10px 0;
    }

    /* call stack */
    .call-stack {
        margin-top: 30px;
        margin-bottom: 40px;
    }

    .call-stack ul li {
        margin: 1px 0;
    }

    .call-stack ul li .element-wrap {
        cursor: pointer;
        padding: 15px 0;
        background-color: #fdfdfd;
    }

    .call-stack ul li.application .element-wrap {
        background-color: #fafafa;
    }

    .call-stack ul li .element-wrap:hover {
        background-color: #edf9ff;
    }


    .call-stack ul li .element {
        min-width: 860px;
        /* 960px-50px * 2 */
        margin: 0 auto;
        padding: 0 50px;
        position: relative;
    }

    .call-stack ul li a {
        color: #505050;
    }

    .call-stack ul li a:hover {
        color: #000;
    }

    .call-stack ul li .item-number {
        width: 45px;
        display: inline-block;
    }

    .call-stack ul li .text {
        color: #aaa;
    }

    .call-stack ul li.application .text {
        color: #505050;
    }

    .call-stack ul li .at {
        float: right;
        display: inline-block;
        width: 7em;
        padding-left: 1em;
        text-align: left;
        color: #aaa;
    }

    .call-stack ul li.application .at {
        color: #505050;
    }

    .call-stack ul li .line {
        display: inline-block;
        width: 3em;
        text-align: right;
    }

    .call-stack ul li .code-wrap {
        display: block;
        position: relative;
    }

    .call-stack ul li.application .code-wrap {
        position: relative;
        /*display: block;*/
    }

    .call-stack ul li .error-line {
        background-color: #ee3d50;
        width: 100%;
        opacity: .3;
    }

    .call-stack ul li .error-line,
    .call-stack ul li .hover-line {
        position: absolute;
    }

    .call-stack ul li .hover-line {
        background: #dddaf0;
    }


    .call-stack ul li .hover-line:hover {
        background: #edf9ff !important;
        cursor: pointer;
    }

    .call-stack ul li .code {
        min-width: 860px;
        /* 960px-50px * 2 */
        margin: 15px auto;
        padding: 0 50px;
        position: relative;
    }
/*

    .call-stack ul li .code .lines-item {
        position: absolute;
        z-index: 200;
        display: block;
        width: 40px;
        text-align: right;
        color: #aaa;
        line-height: 21px;
        font-size: 12px;
        font-family: Consolas, monospace;
    }

    .call-stack ul li .code pre {
        position: relative;
        !*top: -2118px;*!
        z-index: 200;
        left: 50px;
        line-height: 20px;
        font-size: 12px;
        font-family: Consolas, monospace;
        display: inline;
    }
*/

    @-moz-document url-prefix() {
        .call-stack ul li .code pre {
            line-height: 20px;
        }
    }

    /* request */
    .request {
        background-color: #fafafa;
        padding-top: 40px;
        padding-bottom: 40px;
        margin-top: 40px;
        margin-bottom: 1px;
    }

    .request .code {
        min-width: 860px;
        /* 960px-50px * 2 */
        margin: 0 auto;
        padding: 15px 50px;
    }

    .request .code pre {
        font-size: 14px;
        line-height: 18px;
        font-family: Consolas, monospace;
        display: inline;
        word-wrap: break-word;
    }

    /*

            !* footer *!
            .footer {
                position: relative;
                height: 222px;
                min-width: 860px;
                !* 960px-50px * 2 *!
                padding: 0 50px;
                margin: 1px auto 0 auto;
                opacity: .5;
            }

            .footer p {

                padding-bottom: 10px;
            }

            .footer p a {
                color: #505050;
            }

            .footer p a:hover {
                color: #000;
            }

            .footer .timestamp {
                font-size: 14px;
                padding-top: 67px;
                margin-bottom: 28px;
            }

            .footer img {
                position: absolute;
                right: -50px;
            }
    */

    /* highlight.js */
    .comment {
        color: #808080;
        font-style: italic;
    }

    .keyword {
        color: #000080;
    }

    .number {
        color: #00a;
    }

    .number {
        font-weight: normal;
    }

    .string,
    .value {
        color: #0a0;
    }

    .symbol,
    .char {
        color: #505050;
        background: #d0eded;
        font-style: italic;
    }

    .phpdoc {
        text-decoration: underline;
    }

    .variable {
        color: #a00;
    }

    body pre {
        pointer-events: none;
    }

    body.mousedown pre {
        pointer-events: auto;
    }

    .errorLogo {
        width: 100px;
        opacity: .5;
    }

    .firstRow {
        padding-top: 20px;
    }

    .firstCard {
        border-top: 5px solid #2980b9;
        opacity: .9;
        max-height: 200px;
        overflow-y: auto;
    }


</style>
