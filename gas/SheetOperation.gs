/**
 * シート名一覧を作成する
 * ※B2を基準としているのは暫定的
 */
function GetAllSheetName() {
    var activeSheet = SpreadsheetApp.getActiveSpreadsheet().getActiveSheet();
    // B2を基準セルにする
    var activeCell = activeSheet.getRange("B2");

    var sheetList = SpreadsheetApp.getActiveSpreadsheet().getSheets();
    var sheetListLength = sheetList.length;

    for (index = 0; index < sheetListLength; index++) {
        var name = sheetList[index].getName();
        activeCell.offset(index,0).setValue(name);
    }
}
