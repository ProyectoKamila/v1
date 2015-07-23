function circle(){
var PI = Math.PI;

this.area = function (r) {
  return PI * r * r;
};

this.circumference = function (r) {
  return 2 * PI * r;
};
}
exports.circle = circle;