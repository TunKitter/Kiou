// !(function (t) {
//     "use strict";
//     function o() {}
//     (o.prototype.init = function () {
//         t("#inline-editable").Tabledit({
//             inputClass: "form-control form-control-sm",
//             editButton: !1,
//             url: "/admin/users/update",
//             eventType: "dblclick",
//             deleteButton: !1,
//             columns: {
//                 identifier: [0, "id"],
//                 editable: [
//                     [1, "name"],
//                     [2, "email"],
//                     [3, "phone"],
//                 ],
//             },
//         }),
//             t("#category_table").Tabledit({
//                 inputClass: "form-control form-control-sm",
//                 editButton: !1,
//                 url: "/admin/category/update",
//                 eventType: "dblclick",
//                 deleteButton: !1,
//                 columns: {
//                     identifier: [0, "id"],
//                     editable: [[1, "name"]],
//                 },
//             });
//     }),
//         (t.EditableTable = new o()),
//         (t.EditableTable.Constructor = o);
// })(window.jQuery),
//     (function () {
//         "use strict";
//         window.jQuery.EditableTable.init();
//     })();
