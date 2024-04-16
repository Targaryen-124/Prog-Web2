import * as fs from "fs";
function convertDocument(){

const doc = fs.createReadStream("ticket.html");
const request = new model.SplitDocumentOnlineRequest({
    document: doc,
    format: "jpg",
    zipOutput: true
});

const split = wordsApi.splitDocumentOnline(request)
.then((splitDocumentOnlineResult) => {
    console.log("Result of SplitDocumentOnline: ", splitDocumentOnlineResult);
});
}