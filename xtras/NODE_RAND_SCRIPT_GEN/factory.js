const {faker} = require('@faker-js/faker')
const Excel = require('exceljs');
const {readdirSync, rename} = require('fs');
const {resolve} = require('path');
const _ = require('lodash');

/**
 * Generate voter list
 *
 * @param limit
 * @returns {[]}
 */
function get_voters(limit = 10) {
    const voters = [];

    Array.from({length: limit}).forEach(() => {
        voters.push(create_voter());
    });

    return voters;
}

/**
 * Create voter by factory
 *
 * @returns {{member_id: string, email_address: string, name: string, category: string, contact_number: string}}
 */
function create_voter() {
    return {
        name: faker.internet.userName(),
        member_id: faker.random.alphaNumeric(8).toUpperCase(),
        category: faker.name.jobTitle(),
        email_address: faker.internet.email(),
        contact_number: faker.phone.number('+880-####-###-###'),
    };
}

/**
 * Write Excel
 *
 * @param voters
 */
function write_excel(voters = []) {

    if (_.isEmpty(voters))
        return false;

    const voterDataExcelFile = 'voter_data.xlsx'
    const workbook = new Excel.Workbook();
    const sheet = workbook.addWorksheet('Sheet 1');

    sheet.columns = [
        {header: 'name', width: 10, key: 'name'},
        {header: 'member_id', width: 10, key: 'member_id'},
        {header: 'category', width: 10, key: 'category'},
        {header: 'email_address', width: 10, key: 'email_address'},
        {header: 'contact_number', width: 10, key: 'contact_number'},
    ];

    for (let i = 0; i < voters.length; i++) {
        sheet.addRow(Object.values(voters[i]));

        workbook.xlsx.writeFile(voterDataExcelFile)
            .then(function () {
                console.log(`Row - ${i}: ` + Object.values(voters[i]).toString());
            });
    }
}

/**
 * Rename Images
 *
 * @param voters
 */
function rename_images(voters = []) {

    const imageDirPath = resolve(__dirname, 'images');
    const files = readdirSync(imageDirPath);

    const _voters = [...voters];

    if (_.isEmpty(files) || _.isEmpty(_voters))
        return console.log("Voters or Images data are missing!");

    files.forEach((file) => {
        let old_name = imageDirPath + `/${file}`;
        let extension = file.split(/[.]+/).pop().toLowerCase();

        let voter = _voters.pop();

        if (voter && old_name && extension) {
            let member_id = voter.member_id;
            let new_name = imageDirPath + `/${member_id + '.' + extension}`;

            rename(old_name, new_name, (err) => {
                console.log(err);
            });
        }
    });
}

module.exports = {
    get_voters,
    write_excel,
    rename_images
}
