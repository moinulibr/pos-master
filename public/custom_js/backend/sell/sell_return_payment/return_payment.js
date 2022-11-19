
    /*
    |-------------------------------------------------------------------------------
    |-----------------------------------------------
    |payment processing all options, functions
    |----------------------------------------------
    */
        //change payment options
        jQuery(document).on('change','.payment_option_for_sell_return',function(){
            var payment_id = jQuery('.payment_option_for_sell_return option:selected').val();
            if(payment_id)
            {
                //
            }else{
                paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZeroForSellReturn();
                emptyAndHideBankingOptionAllDataForSellReturn();

                cashPaymentRemoveAttributeNameAndRequiredForSellReturn();
                advancePaymentRemoveAttributeNameAndRequiredForSellReturn();
                bankingPaymentRemoveAttributeNameAndRequiredForSellReturn();
            }
            if(payment_id == 1) //only cash
            {
                advancePaymentMakingZeroWithHideForSellReturn();
                bankingPaymentMakingZeroWithHideForSellReturn();
                jQuery('.cash_payment_section_for_sell_return').show(300);

                emptyAndHideBankingOptionAllDataForSellReturn();

                cashPaymentAddAttributeNameAndRequiredForSellReturn();//add
                advancePaymentRemoveAttributeNameAndRequiredForSellReturn();//remove
                bankingPaymentRemoveAttributeNameAndRequiredForSellReturn();//remove
            }
            else if(payment_id == 2) //Only Advance
            {
                cashPaymentMakingZeroWithHideForSellReturn();
                bankingPaymentMakingZeroWithHideForSellReturn();
                jQuery('.advance_payment_section_for_sell_return').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZeroForSellReturn();
                emptyAndHideBankingOptionAllDataForSellReturn();

                advancePaymentAddAttributeNameAndRequiredForSellReturn();//add
                cashPaymentRemoveAttributeNameAndRequiredForSellReturn();//remove
                bankingPaymentRemoveAttributeNameAndRequiredForSellReturn();//remove
            }
            else if(payment_id == 3) //Advance + Cash
            {
                bankingPaymentMakingZeroWithHideForSellReturn();
                jQuery('.cash_payment_section_for_sell_return').show(300);
                jQuery('.advance_payment_section_for_sell_return').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZeroForSellReturn();
                emptyAndHideBankingOptionAllDataForSellReturn();

                cashPaymentAddAttributeNameAndRequiredForSellReturn();//add
                advancePaymentAddAttributeNameAndRequiredForSellReturn();//add
                bankingPaymentRemoveAttributeNameAndRequiredForSellReturn();//remove

            }
            else if(payment_id == 4) //Only Banking
            {
                cashPaymentMakingZeroWithHideForSellReturn();
                advancePaymentMakingZeroWithHideForSellReturn();
                jQuery('.banking_payment_section_for_sell_return').show(300);

                bankingPaymentAddAttributeNameAndRequiredForSellReturn();//add
                cashPaymentRemoveAttributeNameAndRequiredForSellReturn();//add
                advancePaymentRemoveAttributeNameAndRequiredForSellReturn();//remove
            }
            else if(payment_id == 5) //Banking + Cash
            {
                advancePaymentMakingZeroWithHideForSellReturn();
                jQuery('.banking_payment_section_for_sell_return').show(300);
                jQuery('.cash_payment_section_for_sell_return').show(300);

                cashPaymentAddAttributeNameAndRequiredForSellReturn();//add
                bankingPaymentAddAttributeNameAndRequiredForSellReturn();//add
                advancePaymentRemoveAttributeNameAndRequiredForSellReturn();//remove
            }
            else if(payment_id == 6) //Banking + Advance
            {
                cashPaymentMakingZeroWithHideForSellReturn();
                jQuery('.banking_payment_section_for_sell_return').show(300);
                jQuery('.advance_payment_section_for_sell_return').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZeroForSellReturn();

                bankingPaymentAddAttributeNameAndRequiredForSellReturn();//add
                advancePaymentAddAttributeNameAndRequiredForSellReturn();//add
                cashPaymentRemoveAttributeNameAndRequiredForSellReturn();//remove
            }
            else if(payment_id == 7) //Banking + Advance + Cash
            {
                jQuery('.cash_payment_section_for_sell_return').show(300);
                jQuery('.advance_payment_section_for_sell_return').show(300);
                jQuery('.banking_payment_section_for_sell_return').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZeroForSellReturn();

                cashPaymentAddAttributeNameAndRequiredForSellReturn();//add
                advancePaymentAddAttributeNameAndRequiredForSellReturn();//add
                bankingPaymentAddAttributeNameAndRequiredForSellReturn();//add
            }
            else{
                jQuery('.cash_payment_section_for_sell_return').hide();
                jQuery('.advance_payment_section_for_sell_return').hide();
                jQuery('.banking_payment_section_for_sell_return').hide();

                jQuery('.cash_payment_making_zero_for_sell_return').val(0);
                jQuery('.advance_payment_making_zero_for_sell_return').val(0);
                jQuery('.banking_payment_making_zero_for_sell_return').val(0);

                emptyAndHideBankingOptionAllDataForSellReturn();

                cashPaymentRemoveAttributeNameAndRequiredForSellReturn();
                advancePaymentRemoveAttributeNameAndRequiredForSellReturn();
                bankingPaymentRemoveAttributeNameAndRequiredForSellReturn();
            }
            setTotalPayingAmountIsNotMoreThenInvoicePayableAmountForSellReturn();
            setTotalCurrentInvoiceDueAmountForSellReturn();
            submitButtonEnableDisabledAsRequirementByCalculationForSellReturn();
        });

        //cash payment making zero with hide options 
        function cashPaymentMakingZeroWithHideForSellReturn()
        {
            jQuery('.cash_payment_section_for_sell_return').hide();
            jQuery('.cash_payment_making_zero_for_sell_return').val(0);
        }
        //cash payment add attribute name and required 
        function cashPaymentAddAttributeNameAndRequiredForSellReturn()
        {
            jQuery('.account_id_for_sell_return_1').attr('name','account_id_1');
            jQuery('.account_id_for_sell_return_1').attr('required',true);
        }
        //cash payment remove attribute name and required 
        function cashPaymentRemoveAttributeNameAndRequiredForSellReturn()
        {
            jQuery('.account_id_for_sell_return_1').removeAttr('required');
            jQuery('.account_id_for_sell_return_1').removeAttr('name');
        }

        //advance payment making zero with hide options
        function advancePaymentMakingZeroWithHideForSellReturn()
        {
            jQuery('.advance_payment_section_for_sell_return').hide();
            jQuery('.advance_payment_making_zero_for_sell_return').val(0);
        }
        //advance payment  add attribute name and required
        function advancePaymentAddAttributeNameAndRequiredForSellReturn()
        {
            jQuery('.account_id_for_sell_return_2').attr('name','account_id_2');
            jQuery('.account_id_for_sell_return_2').attr('required',true);
        }
        //advance payment  remove attribute name and required
        function advancePaymentRemoveAttributeNameAndRequiredForSellReturn()
        {
            jQuery('.account_id_for_sell_return_2').removeAttr('required');
            jQuery('.account_id_for_sell_return_2').removeAttr('name');
        }

        //banking payment makeing zero with hide optoins
        function bankingPaymentMakingZeroWithHideForSellReturn()
        {
            jQuery('.banking_payment_section_for_sell_return').hide();
            jQuery('.banking_payment_making_zero_for_sell_return').val(0);
        }
        //banking payment  add attribute name and required
        function bankingPaymentAddAttributeNameAndRequiredForSellReturn()
        {
            jQuery('.account_id_for_sell_return_3').attr('name','account_id_for_sell_return_3');
            jQuery('.account_id_for_sell_return_3').attr('required',true);
        }
        //banking payment  remove attribute name and required
        function bankingPaymentRemoveAttributeNameAndRequiredForSellReturn()
        {
            jQuery('.account_id_for_sell_return_3').removeAttr('required');
            jQuery('.account_id_for_sell_return_3').removeAttr('name');
        }

        //advance different paying amount option making disabled when advance zero
        function advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZeroForSellReturn()
        {
            var advanceAmount = nanCheckForSellReturnPayment(parseFloat(jQuery('.total_advance_amount').val()));
            if(advanceAmount == 0)
            {
                jQuery('.advance_payment_value_for_sell_return').val(0);
                jQuery('.advance_payment_value_for_sell_return').attr('disabled',true);
                jQuery('.advance_payment_value_for_sell_return').css({
                    'background-color':'red','color':'#ffff'
                });
            }else{
                jQuery('.advance_payment_value_for_sell_return').removeAttr('disabled');
                jQuery('.advance_payment_value_for_sell_return').css({
                    'background-color':'green','color':'#ffff'
                });
            }
        }



        //when change invoice continue with
        jQuery(document).on('change','.invoice_continue_with_for_sell_return',function()
        {
            var invoice_continue_type = jQuery('.invoice_continue_with_for_sell_return option:selected').val();
            if(invoice_continue_type == 1) //due
            {
                jQuery('.payment_option_for_sell_return option[value=0]').prop('selected',true);
                jQuery('.payment_option_for_sell_return').attr('disabled',true);
                paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZeroForSellReturn();
                cashPaymentMakingZeroWithHideForSellReturn();
                advancePaymentMakingZeroWithHideForSellReturn();
                bankingPaymentMakingZeroWithHideForSellReturn();

                emptyAndHideBankingOptionAllDataForSellReturn();
            }else{
                jQuery('.payment_option_for_sell_return').removeAttr('disabled');

                //first time cash is open
                jQuery('.payment_option_for_sell_return option[value=1]').prop('selected',true);
                jQuery('.cash_payment_section_for_sell_return').show(300);
                jQuery('.cash_payment_value_for_sell_return').focus();
            }
            submitButtonEnableDisabledAsRequirementByCalculationForSellReturn();
        });
        //payment Processing With Due Full Amount And Paying Amount Zero
        function paymentProcessingWithDueFullAmountAndPayingAmountZeroForSellReturn()
        {
            var totalInvoicePayableAmount = nanCheckForSellReturnPayment(parseFloat(jQuery('.total_sell_return_invoice_payable_amount').text()));
            jQuery('.invoice_paying_amount_for_sell_return').val(0);
            jQuery('.invoice_due_amount_for_sell_return').val(totalInvoicePayableAmount);
        }
        //payment Processing With Due Full Amount And Paying Amount Disabled And Zero
        function paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZeroForSellReturn()
        {
            var totalInvoicePayableAmount = nanCheckForSellReturnPayment(parseFloat(jQuery('.total_sell_return_invoice_payable_amount').text()));
            jQuery('.invoice_paying_amount_for_sell_return').val(0);
            jQuery('.invoice_due_amount_for_sell_return').val(totalInvoicePayableAmount);
            jQuery('.invoice_paying_amount_for_sell_return').attr('readonly',true);

            //paying different method
            jQuery('.cash_payment_value_for_sell_return').val(0);
            jQuery('.advance_payment_value_for_sell_return').val(0);
            jQuery('.banking_payment_value_for_sell_return').val(0);
        }

        //new payment Processing With Due Full Amount And All Paying Amount Zero
        function paymentProcessingWithDueFullAmountAndAllPayingAmountZeroForSellReturn()
        {
            //paying different method 
            jQuery('.cash_payment_value_for_sell_return').val(0);
            jQuery('.advance_payment_value_for_sell_return').val(0);
            jQuery('.banking_payment_value_for_sell_return').val(0);
            var totalInvoicePayableAmount = nanCheckForSellReturnPayment(parseFloat(jQuery('.total_sell_return_invoice_payable_amount').text()));
            jQuery('.invoice_paying_amount_for_sell_return').val(0);
            jQuery('.invoice_due_amount_for_sell_return').val(totalInvoicePayableAmount);
        }


        //when pressing paying different method : keyup method
        jQuery(document).on('keyup','.paying_different_method_for_sell_return',function()
        {
            var pressingAmount = nanCheckForSellReturnPayment(parseFloat(jQuery(this).val()));
            var currentPressableAmount = setCurrentPressingDifferentAmountAfterAllCalculationForSellReturn(pressingAmount);
            jQuery(this).val(currentPressableAmount);
            calculationTotalPayingDifferentAllMethodsAmountForSellReturn();
            setTotalPayingAmountIsNotMoreThenInvoicePayableAmountForSellReturn();
            setTotalCurrentInvoiceDueAmountForSellReturn();

            submitButtonEnableDisabledAsRequirementByCalculationForSellReturn();
        });

        //set current pressing different amount after all calculation
        function setCurrentPressingDifferentAmountAfterAllCalculationForSellReturn(pressingAmount)
        { 
            var totalInvoicePayableAmount = nanCheckForSellReturnPayment(parseFloat(jQuery('.total_sell_return_invoice_payable_amount').text()));
            var totalDifferentAmountExceptCurrentType = getTotalPayingDifferentAmountExceptCurrentPressingAmountForSellReturn(pressingAmount);
            var currentRemainingAmount = totalInvoicePayableAmount - totalDifferentAmountExceptCurrentType ;
            var currentPressableAmount = 0;
            if(pressingAmount <= currentRemainingAmount)
            {
                currentPressableAmount = pressingAmount;
            }else{
                currentPressableAmount = currentRemainingAmount;
            }
            return currentPressableAmount;
        }

        //get total different methods amount except current pressing amount
        function getTotalPayingDifferentAmountExceptCurrentPressingAmountForSellReturn(pressingAmount)
        {
            var total = calculationTotalPayingDifferentAllMethodsAmountForSellReturn();
            return total - pressingAmount;
        }

        //set total paying amount not more then invoice payable amount
        function setTotalPayingAmountIsNotMoreThenInvoicePayableAmountForSellReturn()
        {
            var totalInvoicePayableAmount = nanCheckForSellReturnPayment(parseFloat(jQuery('.total_sell_return_invoice_payable_amount').text()));
            var allMethodAmount =  calculationTotalPayingDifferentAllMethodsAmountForSellReturn();
        
            if(totalInvoicePayableAmount >= allMethodAmount)
            {
                jQuery('.invoice_paying_amount_for_sell_return').val(allMethodAmount)
            }else{
                jQuery('.invoice_paying_amount_for_sell_return').val(totalInvoicePayableAmount)
            }
        }

        //total paying from all different methods
        function calculationTotalPayingDifferentAllMethodsAmountForSellReturn()
        {
            var total = 0;
            jQuery(".paying_different_method_for_sell_return").each(function() {
                total += nanCheckForSellReturnPayment(parseFloat(jQuery(this).val()));
            });
            return total = ((total).toFixed(2));
        }

        //current invoice due amount
        function setTotalCurrentInvoiceDueAmountForSellReturn()
        {
            var totalInvoicePayableAmount = nanCheckForSellReturnPayment(parseFloat(jQuery('.total_sell_return_invoice_payable_amount').text()));
            //var currentInvoiceBeforePressingAmont = nanCheckForSellReturnPayment(parseFloat(jQuery('.invoice_due_amount').val()));
            var currentPayingAmount = calculationTotalPayingDifferentAllMethodsAmountForSellReturn(); 
            var currentDue =  (totalInvoicePayableAmount - currentPayingAmount);
            jQuery('.invoice_due_amount_for_sell_return').val(currentDue);
        }

        //this is used for first time in the sell_return/index.js file
        function linkBetweenSellReturnFunctionAndSellReturnPaymentOption()
        {
            var totalReturnAmountAfterDiscount = $('.total_return_amount_after_discount_val').val();
            $('.total_sell_return_invoice_payable_amount').text(totalReturnAmountAfterDiscount);
            $('.total_invoice_amount_for_calculator_for_sell_return').val(totalReturnAmountAfterDiscount);
            if(totalReturnAmountAfterDiscount > 0)
            { 
                submitButtonEnableForSellReturn();
                var currentPayingAmount = calculationTotalPayingDifferentAllMethodsAmountForSellReturn(); 
                if(currentPayingAmount > totalReturnAmountAfterDiscount)
                {
                    paymentProcessingWithDueFullAmountAndAllPayingAmountZeroForSellReturn();
                    paymentProcessingWithDueFullAmountAndPayingAmountZeroForSellReturn();
                }
                else if(currentPayingAmount <= totalReturnAmountAfterDiscount)
                { 
                    paymentProcessingWithDueFullAmountAndAllPayingAmountZeroForSellReturn();
                    paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZeroForSellReturn();
                    emptyAndHideBankingOptionAllDataForSellReturn();
                    paymentProcessingWithDueFullAmountAndPayingAmountZeroForSellReturn();
                }
                else{
                    paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZeroForSellReturn();
                    emptyAndHideBankingOptionAllDataForSellReturn();
                }
            }else{
                submitButtonDisabledForSellReturn();
                paymentProcessingWithDueFullAmountAndPayingAmountZeroForSellReturn();
                paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZeroForSellReturn();
                emptyAndHideBankingOptionAllDataForSellReturn();
            }
        }
        //this is used for first time in the sell_return/index.js file

        //banking option all data
        function emptyAndHideBankingOptionAllDataForSellReturn()
        {
            jQuery('.rendering_payment_banking_option_data_for_sell_return').html('');
            jQuery('.banking_option_data_for_sell_return option[value=0]').prop('selected',true);
        }
        //change banking option data
        jQuery(document).on('change','.banking_option_data_for_sell_return',function(){
            var banking_option_id = jQuery('.banking_option_data_for_sell_return option:selected').val();
            submitButtonEnableDisabledAsRequirementByCalculationForSellReturn();
            var url = jQuery('.paymentBankingOptionUrl').val();
            jQuery.ajax({
                url:url,
                data:{banking_option_id:banking_option_id},
                beforeSend:function(){
                    jQuery('.processing').fadeIn();
                },
                success:function(response){
                    if(response.status == true)
                    {
                        jQuery('.rendering_payment_banking_option_data_for_sell_return').html(response.list);
                    }
                },
                complete:function(){
                    jQuery('.processing').fadeOut();
                },
            });
        });
        //banking option all data
        
        //change banking transaction type
        jQuery(document).on('change','.banking_transaction_type',function()
        {
            var banking_type = jQuery('.banking_transaction_type option:selected').val();
            if(banking_type == 1) //direct deposit
            {
                jQuery('.bank_banking_transfer_section').hide();
                jQuery('.bank_banking_cheque_section').hide(100);
            }
            else if(banking_type == 2) //cheque
            {
                jQuery('.bank_banking_transfer_section').hide();
                jQuery('.bank_banking_cheque_section').show(300);
            }
            else if(banking_type == 3) //online transfer
            {
                jQuery('.bank_banking_cheque_section').hide();
                jQuery('.bank_banking_transfer_section').show(300);
            }
        });
        //change banking transaction type



        //enable disabled submit button
        function submitButtonEnableDisabledAsRequirementByCalculationForSellReturn()
        {
            var invoice_continue_type = jQuery('.invoice_continue_with_for_sell_return option:selected').val();
            //if(invoice_continue_type == 1)//due
            if(invoice_continue_type == 2)//payment
            {
                var totalPayingAmount = calculationTotalPayingDifferentAllMethodsAmountForSellReturn();
                
                var payment_option = jQuery('.payment_option_for_sell_return option:selected').val();
            
                
                if(totalPayingAmount > 0 && payment_option > 0 &&  payment_option <= 3)
                {
                    submitButtonEnableForSellReturn();
                } 
                else if(totalPayingAmount > 0 && payment_option >= 4 &&  payment_option <= 7)
                {
                    var banking_option_id = jQuery('.banking_option_data_for_sell_return option:selected').val();
                    if(banking_option_id > 0)
                    {
                        submitButtonEnableForSellReturn();
                    }else{
                        submitButtonDisabledForSellReturn();
                    }
                }
                else{
                    submitButtonDisabledForSellReturn();
                }
            }else{
                submitButtonEnableForSellReturn();
            }
            exchangeGivenAmountAfterCalculatorForSellReturn();
        }
        //submit button disabled
        function submitButtonDisabledForSellReturn()
        {
            jQuery('.submitButton_for_sell_return').attr('disabled',true); 
        }
        //submit button enabled
        function submitButtonEnableForSellReturn()
        {
            jQuery('.submitButton_for_sell_return').removeAttr('disabled'); 
        }
        //enable disabled submit button


        //calculator
        jQuery(document).on('click','.customer_calculator_button_for_sell_return',function(){
            jQuery('.customer_calculator_for_sell_return').show(300);
            jQuery('.customer_calculator_button_for_sell_return').hide(300);
        });
        jQuery(document).on('click','.customer_calculator_close_for_sell_return',function(){
            jQuery('.customer_calculator_for_sell_return').hide(300);
            jQuery('.customer_calculator_button_for_sell_return').show(300);
        });
        jQuery(document).on('keyup','.given_amount_for_calculator_for_sell_return',function()
        {
            exchangeGivenAmountAfterCalculatorForSellReturn();
        });
        function exchangeGivenAmountAfterCalculatorForSellReturn()
        {
            var invoice_amount = nanCheckForSellReturnPayment(parseFloat(jQuery('.total_invoice_amount_for_calculator_for_sell_return').val()));
            var paing_amount_cal = nanCheckForSellReturnPayment(parseFloat(jQuery('.total_paying_amount_for_calculator_for_sell_return').val()));
            var given_amount = nanCheckForSellReturnPayment(parseFloat(jQuery('.given_amount_for_calculator_for_sell_return').val()));
            
            if(paing_amount_cal > 0 && given_amount > 0 && given_amount > paing_amount_cal)
            {
                var totalReturnAmount = paing_amount_cal - given_amount;
                totalReturnAmount = totalReturnAmount.toFixed(2);
                jQuery('.return_amount_for_calculator_for_sell_return').val(totalReturnAmount);
            }else{
                jQuery('.return_amount_for_calculator_for_sell_return').val(0.0);
            }
        }
        //calculator
    /*
    |-------------------------------------------------------------------------------
    |-----------------------------------------------
    |payment processing all options, functions
    |----------------------------------------------
    */
      


    
    function nanCheckForSellReturnPayment(value)
    {
        if(isNaN(value))
        {
            return 0;
        }
        else{
            return value;
        }
    }