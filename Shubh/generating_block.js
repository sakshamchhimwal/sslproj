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
                    if(line.charAt(i)==="\t"){
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

    main();
    