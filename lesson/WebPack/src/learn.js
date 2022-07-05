let i = 2;
global.i = i;
let myName = "Gone";
global.myName = myName;
export  {i, myName};
export default class {
    constructor(){
        console.log(i, myName);
    }
}
export function sum1(a,b){
    return a+b;
}
export function run(a){
    console.log("run ",a);
}
// export {sum1(a,b),run()}