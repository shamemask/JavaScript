import $ from "jquery";
global.$ = $;
import css from "./style.css";
import Learn, {sum1,run} from "./learn"

new Learn();
console.log(Learn.myName,Learn.i);

run(sum1(3,6));

import Article from "./article";

let article = new Article({
     head: "text",
    description: "deals"
});

article.render();
