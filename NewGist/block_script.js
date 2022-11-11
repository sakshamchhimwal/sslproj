    function main(){
        let array_obj = StripCode(text);
        console.log(array_obj);
        let tab_count_array_obj = TabCounter(array_obj);
        console.log(tab_count_array_obj);
        tab_count_array_obj = TabCount(array_obj);
        console.log(tab_count_array_obj);
        if_pair_array = checkIfInCode(array_obj, tab_count_array_obj, 0);
        console.log(if_pair_array);
        for_pair_array = checkForInCode(array_obj, tab_count_array_obj, 0);
        console.log(for_pair_array);
        while_pair_array = checkWhileInCode(array_obj,  tab_count_array_obj, 0);
        console.log(while_pair_array);
        if_processed_count = Process_if_array(if_pair_array);
        console.log(if_processed_count);
    }

    let text = `for i in range(9):
        if i == 0:
            print('I is zero')
        else if i%2==0:
            print('I is even')
        else if i%3 ==  0:
            print("Hiii")
        else:
            print('I is Odd')
`;

    /**
     * @param {String} code - Python Code
     * @return the array of stripped code blocks
    */
    function StripCode(code){
        let strippedCode = code.split("\n");
        return strippedCode;
    }

    /**
     * @param {Array Object}iterable_array - intended for the returned object of StripCode
     * @return the no. of tabs count before start of the code
    */
    function TabCount(iterable_array){
        let tab_count_array = [];
        for (const line of iterable_array){
            if(line === ""){
                tab_count_array.push(0);
            }
            else{
                let count = 0;
                for (var i = 0; i < line.length; i++) {
                    if(line.charAt(i)===" "){
                        count ++;
                    }
                    else if(line.charAt(i)==="#"){
                        count = count + 1000000;
                        break;
                    }
                    else {
                        break;
                    }
                }
                tab_count_array.push(count);
            }
        }
        return tab_count_array;
    }

    /**
     * @param {Array Object}iterable_array - intended for the returned object of StripCode
     * @return the no. of tabs count in a single line
    */
    function TabCounter(iterable_array){
        let tab_count_array = [];
        for (const line of iterable_array){
            if(line === ""){
                tab_count_array.push(0);
            }
            else {
                  var count = 0;
                var index = 0;
                while (line.charAt(index++) === "\t") {
                    count++;
                }
                tab_count_array.push(count);
            }
        }
        return tab_count_array;
    }

    /**
     * @param {Stirg}line - the code if in which we need to check if 'if' is present
     * @return {bool} - 'True/False
    */
    function check_if(line) {
        //console.log("hi");
        if (line.includes("#", 0)){
            if(line.indexOf("#") < line.indexOf("if")){
                return false;
            }
        }
        return (line.includes("if ", 0) || line.includes("if(", 0));
    }

    /**
     * @param {Array Object}iterable_array - intended for the returned object of StripCode
     * @param {Array Object}tab_array - the returned object of TabCounter
     * @param {Int}start_index - the index from which we require to start
     * @return the pair of start and end index of if
    */
    function checkIfInCode(iterable_array, tab_array, start_index) {
        let if_dict = [[], []]
        for (var i=start_index; i<iterable_array.length; i++){
            if (check_if(iterable_array[i])){
                if_dict[0].push(i);
                for(var j = i+1; j<iterable_array.length; j++){
                    if(tab_array[j] <= tab_array[i]){
                        if_dict[1].push(j);
                        break
                    }
                }
            }
        }
        return if_dict;
    }

    /**
     * @param {Stirg}line - the code if in which we need to check if 'for' is present
     * @return {boolParam}
    */
    function check_for(line) {
        if (line.includes("#", 0)){
            if(line.indexOf("#") < line.indexOf("for")){
                return false;
            }
        }
        return line.includes("for", 0);
    }

    /**
     * @param {Array Object}iterable_array - intended for the returned object of StripCode
     * @param {Array Object}tab_array - the returned object of TabCounter
     * @param {Int}start_index - the index from which we require to start
     * @return the pair of start and end index of for
    */
    function checkForInCode(iterable_array, tab_array, start_index) {
        let for_pair_array = [];
        for (var i=start_index; i<iterable_array.length; i++){
            if (check_for(iterable_array[i])){
                for_pair_array.push(i);
                for(var j = i+1; j<iterable_array.length; j++){
                    if(tab_array[j] <= tab_array[i]){
                        for_pair_array.push(j);
                        break
                    }
                }
            }
        }
        return for_pair_array;
    }

    /**
     * @param {Stirg}line - the code if in which we need to check if 'else' is present
     * @return {boolParam}
    */
    function check_else(line) {
        if (line.includes("#", 0)){
            if(line.indexOf("#") < line.indexOf("else")){
                return false;
            }
        }
        return line.includes("else", 0);
    }

    /**
     * @param {Array Object}iterable_array - intended for the returned object of StripCode
     * @param {Array Object}tab_array - the returned object of TabCounter
     * @param {Int}start_index - the index from which we require to start
     * @return the pair of start and end index of else
    */
    function checkElseInCode(iterable_array, tab_array, start_index) {
        let else_pair_array = [];
        for (var i=start_index; i<iterable_array.length; i++){
            if (check_else(iterable_array[i])){
                else_pair_array.push(i);
                for(var j = i+1; j<iterable_array.length; j++){
                    if(tab_array[j] <= tab_array[i]){
                        else_pair_array.push(j);
                        break
                    }
                }
            }
        }
        return else_pair_array;
    }

    /**
     * @param {Stirg}line - the code if in which we need to check if 'while' is present
     * @return {boolParam}
    */
    function check_while(line) {
        if (line.includes("#", 0)){
            if(line.indexOf("#") < line.indexOf("while")){
                return false;
            }
        }
        return (line.includes("while ", 0) || line.includes("while ", 0));
    }

    /**
     * @param {Array Object}iterable_array - intended for the returned object of StripCode
     * @param {Array Object}tab_array - the returned object of TabCounter
     * @param {Int}start_index - the index from which we require to start
     * @return the pair of start and end index of while
    */
    function checkWhileInCode(iterable_array, tab_array, start_index) {
        let while_pair_array = [];
        for (var i=start_index; i<iterable_array.length; i++){
            if (check_while(iterable_array[i])){
                while_pair_array.push(i);
                for(var j = i+1; j<iterable_array.length; j++){
                    if(tab_array[j] <= tab_array[i]){
                        while_pair_array.push(j);
                        break
                    }
                }
            }
        }
        return while_pair_array;
    }

    /**
     * @NOTE : Do not use this one, made for another type if if_array input
     * @param {ArrayObject} if_count_array - expects the if_count_array
     * @returns its processed version
    */
    function __Process_if_array(if_count_array){
        if_processed_count = [];
        pos_array = []
        for (var i=0; i<if_count_array.length - 1; i++){
            if(if_count_array[i][1] === if_count_array[i+1][0]){
                pos_array.push(i);
            }
        }
        console.log(pos_array);
        for(var i=0; i<if_count_array.length; i++){
            if(pos_array.indexOf(i) === -1){
                if_processed_count.push(if_count_array[i][0]);
                if_processed_count.push(if_count_array[i][1]);
            }
            else{
                if_processed_count.push(if_count_array[i][0]);
                while(pos_array.indexOf(++i)!=-1){console.log("Hi")}; // i++ was a mistake
                console.log(if_processed_count);
                if_processed_count.push(if_count_array[i][1]);
            }
        }
        return if_processed_count;
    }

    /**
     * @param : {ArrayObject} if_count_array - expects the if_count_array
     * @returns the processed version off iff array
    */
    function Process_if_array(if_count_array){
        let if_processed_count = [];
        let pos_array = [];
        for (var i=0; i<if_count_array[0].length - 1; i++){
            if(if_count_array[1][i] === if_count_array[0][i+1]){
                pos_array.push(i);
            }
        }
        console.log(pos_array);
        for(var i=0; i<if_count_array.length; i++){
            if(pos_array.indexOf(i) === -1){
                if_processed_count.push(if_count_array[0][i]);
                if_processed_count.push(if_count_array[1][i]);
            }
            else{
                if_processed_count.push(if_count_array[0][i]);
                while(pos_array.indexOf(++i)!=-1){console.log("Hii")}; // i++ was a mistake
                if_processed_count.push(if_count_array[1][i]);
            }
        }
        return if_processed_count;
    }

    /**
     * @param {Code} code_text which requires all the operation
     * @return the control flow of program
    */
    function GetFlowOfProgram(Code){
        code_lines = StripCode(Code);
        initial_tab_count = TabCount(code_lines);
        if_array = checkIfInCode(code_lines, initial_tab_count, 0);
        for_array = checkForInCode(code_lines, initial_tab_count, 0);
        while_array = checkWhileInCode(code_lines, initial_tab_count, 0);
    }

     /**
     * @param {Array Object}iterable_array - intended for the returned object of StripCode
     * @param {Array Object}tab_array - the returned object of TabCounter
     * @param {Int}start_index - the index from which we require to start
     * @return the pair of start and end index of def
    */
    function checkDefInCode(iterable_array, tab_array, start_index) {
        let def_dict = [[], []]
        for (var i=start_index; i<iterable_array.length; i++){
            if (check_def(iterable_array[i])){
                def_dict[0].push(i);
                for(var j = i+1; j<iterable_array.length; j++){
                    if(tab_array[j] <= tab_array[i]){
                        def_dict[1].push(j);
                        break
                    }
                }
            }
        }
        return def_dict;
    }


    /**
     * @param {Stirg}line - the code if in which we need to check if 'def' is present
     * @return {boolParam}
    */
    function check_def(line) {
        if (line.includes("#", 0)){
            if(line.indexOf("#") < line.indexOf("def")){
                return false;
            }
        }
        return line.includes("def ", 0);
    }


    /**
     * @param {Array Object}iterable_array - intended for the returned object of StripCode
     * @param {Dict Object}def_dict - the def initial and ending pointa giiven
     * @return {Array Object} - the names of function with index corresponding to the def_dict
    */
    function get_function_name(iterable_array, def_dict){
        let func_names = [];
        for(var i=0; i<def_dict[0].length; i++){
            let line = iterable_array[def_dict[0][i]];
            line = line.trimStart();
            let space_pos = line.indexOf(" ");
            let brac_pos = line.indexOf("(");
            let func_name_part = line.slice(space_pos+1, brac_pos);
            func_name_part = func_name_part.trim();
            func_names.push(func_name_part);
        }
        return func_names;
    }


    /**
     * @param {Array Object}iterable_array - intended for the returned object of StripCode
     * @param {Dict Object}def_dict - the def initial and ending pointa given
     * @param {Int} func_index - the index of the function woy need parameter of
     * @return the function paramms of the given function
     */
    function get_func_parameter(iterable_array, def_dict, func_index){
        if(func_index >= def_dict[0].length) return null;
        let name = iterable_array[def_dict[0][func_index]];
        first_brac_pos = name.indexOf("(");
        last_brac_pos = name.lastIndexOf(")");
        let params = name.slice(first_brac_pos+1, last_brac_pos);
        let param_array = params.split(",");
        return param_array;
    }

     /**
     * @param {Array Object}iterable_array - intended for the returned object of StripCode
     * @param {Dict Object}def_dict - the def initial and ending pointa given
     * @return {Int} the nu,mber of parameter of each function
     */
    function get_func_parameter_count(iterable_array, def_dict){
        param_count = []
        for (var i=0; i<def_dict[0].length; i++){
            let line = iterable_array[def_dict[0][func_index]];
            first_brac_pos = name.indexOf("(");
            last_brac_pos = name.lastIndexOf(")");
            var flag = false;
            for(var j=first_brac_pos+1; j<last_brac_pos; j++){
                if(line.charAt(j)!=" " || line.chatAt(j) !== ""){
                    param_count.push((line.split(",")).length);
                    flag = true;
                    break;
                }
            }
            if(!flag){param_count.push(0)};
        }
    }



    /**
     * @param {Array Object}iterable_array - intended for the returned object of StripCode
     * @param {if Object}def_dict - the def initial and ending pointa given of the if
     * @return {Array Object} - the condition inside the if block
    */
    function get_if_condition(iterable_array, if_dict){
        let if_conditions = [];
        for(var i=0; i<if_dict[0].length; i++){
            let line = iterable_array[if_dict[0][i]];
            line = line.trimStart();
            let space_pos = line.indexOf("(");
            let brac_pos = line.indexOf(")");
            if( space_pos != -1 && brac_pos != -1){
                let func_name_part = line.slice(space_pos+1, brac_pos);
                func_name_part = func_name_part.trim();
            }
            else{
                space_pos = line.indexOf(" ");
                brac_pos = line.indexOf(":");
                let func_name_part = line.slice(space_pos+1, brac_pos);
                func_name_part = func_name_part.trim();
            }
            if_conditions.push(func_name_part);
        }
        return if_conditions;
    }

    /**
     * @param {Array_Object} The returned object of the StripCode
     * @param {Array_object} the for array positions
     * @returns NaN if range is not present else the number of iterations are returned
    */
    function get_range_for(iterable_array, for_array){
        let range_list = [];
        for(var i=0; i<for_array.length; i=i+2){
            let line = iterable_array[for_array[i]];
            line = line.trimStart();
            let range_pos = line.indexOf("range(");
            //console.log(range_pos);
            if(range_pos === -1){
                range_list.push(NaN);
            }
            else {
                range_pos = range_pos + 6;
                line = line.slice(range_pos);
                let back_pos = line.indexOf(")");
                line = line.slice(0, back_pos);
                line_arr = line.split(",");
                //console.log(line_arr);
                let line_arr_length = line_arr.length;
                if(line_arr_length === 1){
                    let num = Number.parseInt(line_arr[0]);
                    range_list.push(num);
                }
                else if(line_arr_length === 2){
                    let num1 = Number.parseInt(line_arr[0]);
                    let num2 = Number.parseInt(line_arr[1]);
                    range_list.push(num2-num1);
                }
                else if (line_arr_length === 3){
                    let num1 = Number.parseInt(line_arr[0]);
                    let num2 = Number.parseInt(line_arr[1]);
                    let num3 = Number.parseInt(line_arr[2]);
                    let diff = Math.abs(num2-num1);
                    range_list.push(Math.floor(diff/Math.abs(num3)));
                }
            }
        }
        return range_list;
    }
