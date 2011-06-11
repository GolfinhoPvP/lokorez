//arquivo circulo.js
var PI = Math.PI;

exports.nome = "circulo.js";

exports.area = function (r) {
  return PI * r * r;
};

exports.circunferencia = function (r) {
  return 2 * PI * r;
};
