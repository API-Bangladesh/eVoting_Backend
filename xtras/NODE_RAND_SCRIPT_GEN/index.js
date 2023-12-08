const {get_voters, write_excel, rename_images} = require('./factory');

const voters = get_voters(1000);
write_excel(voters);
rename_images(voters);
