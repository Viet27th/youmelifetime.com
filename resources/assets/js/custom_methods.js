let methods = {
  toSlug: function (str) {
    // loại bỏ toàn bộ dấu space (nếu có) ở 2 đầu của xâu
    str = str.trim();
    //Loại bỏ tất cả các kí tự không phải chữ cái và số và dấu -
    str = str.replace(/[^0-9a-z-àáạảãâầấậẩẫăằắặẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơờớợởỡùúụủũưừứựửữỳýỵỷỹđ\s]/gi, '');
    //loại bỏ hoàn toàn dấu câu tiếng Việt, không phân biệt hoa thường.
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    str = str.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    str = str.replace(/Đ/g, "D");
    //thay chữ hoa thành chữ thường
    str = str.replace(/A/g, 'a');
    str = str.replace(/B/g, 'b');
    str = str.replace(/C/g, 'c');
    str = str.replace(/D/g, 'd');
    str = str.replace(/E/g, 'e');
    str = str.replace(/F/g, 'f');
    str = str.replace(/G/g, 'g');
    str = str.replace(/H/g, 'h');
    str = str.replace(/I/g, 'i');
    str = str.replace(/K/g, 'k');
    str = str.replace(/L/g, 'l');
    str = str.replace(/M/g, 'm');
    str = str.replace(/N/g, 'n');
    str = str.replace(/O/g, 'o');
    str = str.replace(/P/g, 'p');
    str = str.replace(/Q/g, 'q');
    str = str.replace(/T/g, 't');
    str = str.replace(/U/g, 'u');
    str = str.replace(/V/g, 'v');
    str = str.replace(/X/g, 'x');
    str = str.replace(/Y/g, 'y');
    str = str.replace(/Z/g, 'z');
    str = str.replace(/W/g, 'w');
    str = str.replace(/J/g, 'j');
    str = str.replace(/R/g, 'r');
    str = str.replace(/S/g, 's');
    // Gộp nhiều dấu space thành 1 space
    str = str.replace(/\s+/g, ' ');
    //thay toàn bộ space bằng "-"
    str = str.replace(/ /g, '-');
    return str;
  },
}
export default methods