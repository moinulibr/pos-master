
    $(document).on('click','.singleSellInvoiceReceivePaymentModalView',function(e){
        e.preventDefault();
        var url = $('.sellViewSingleInvoiceReceivePaymentModalRoute').val();
        var id = $(this).data('id');
        $.ajax({
            url:url,
            data:{id:id},
            success:function(response){
                if(response.status == true)
                {
                    $('#sellViewSingleInvoiceReceivePaymentModal').html(response.html).modal('show');
                    paymentProcessingWithDueFullAmountAndPayingAmountZero();
                }
            }
        });
    });



        
    /*
    |-------------------------------------------------------------------------------
    |-----------------------------------------------
    |payment processing all options, functions
    |----------------------------------------------
    */
        //change payment options
        jQuery(document).on('change','.payment_option',function(){
            var payment_id = jQuery('.payment_option option:selected').val();
            if(payment_id)
            {
                //
            }else{
                paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZero();
                emptyAndHideBankingOptionAllData();

                cashPaymentRemoveAttributeNameAndRequired();
                advancePaymentRemoveAttributeNameAndRequired();
                bankingPaymentRemoveAttributeNameAndRequired();
            }
            if(payment_id == 1) //only cash
            {
                advancePaymentMakingZeroWithHide();
                bankingPaymentMakingZeroWithHide();
                jQuery('.cash_payment_section').show(300);

                emptyAndHideBankingOptionAllData();

                cashPaymentAddAttributeNameAndRequired();//add
                advancePaymentRemoveAttributeNameAndRequired();//remove
                bankingPaymentRemoveAttributeNameAndRequired();//remove
            }
            else if(payment_id == 2) //Only Advance
            {
                cashPaymentMakingZeroWithHide();
                bankingPaymentMakingZeroWithHide();
                jQuery('.advance_payment_section').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZero();
                emptyAndHideBankingOptionAllData();

                advancePaymentAddAttributeNameAndRequired();//add
                cashPaymentRemoveAttributeNameAndRequired();//remove
                bankingPaymentRemoveAttributeNameAndRequired();//remove
            }
            else if(payment_id == 3) //Advance + Cash
            {
                bankingPaymentMakingZeroWithHide();
                jQuery('.cash_payment_section').show(300);
                jQuery('.advance_payment_section').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZero();
                emptyAndHideBankingOptionAllData();

                cashPaymentAddAttributeNameAndRequired();//add
                advancePaymentAddAttributeNameAndRequired();//add
                bankingPaymentRemoveAttributeNameAndRequired();//remove

            }
            else if(payment_id == 4) //Only Banking
            {
                cashPaymentMakingZeroWithHide();
                advancePaymentMakingZeroWithHide();
                jQuery('.banking_payment_section').show(300);

                bankingPaymentAddAttributeNameAndRequired();//add
                cashPaymentRemoveAttributeNameAndRequired();//add
                advancePaymentRemoveAttributeNameAndRequired();//remove
            }
            else if(payment_id == 5) //Banking + Cash
            {
                advancePaymentMakingZeroWithHide();
                jQuery('.banking_payment_section').show(300);
                jQuery('.cash_payment_section').show(300);

                cashPaymentAddAttributeNameAndRequired();//add
                bankingPaymentAddAttributeNameAndRequired();//add
                advancePaymentRemoveAttributeNameAndRequired();//remove
            }
            else if(payment_id == 6) //Banking + Advance
            {
                cashPaymentMakingZeroWithHide();
                jQuery('.banking_payment_section').show(300);
                jQuery('.advance_payment_section').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZero();

                bankingPaymentAddAttributeNameAndRequired();//add
                advancePaymentAddAttributeNameAndRequired();//add
                cashPaymentRemoveAttributeNameAndRequired();//remove
            }
            else if(payment_id == 7) //Banking + Advance + Cash
            {
                jQuery('.cash_payment_section').show(300);
                jQuery('.advance_payment_section').show(300);
                jQuery('.banking_payment_section').show(300);
                advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZero();

                cashPaymentAddAttributeNameAndRequired();//add
                advancePaymentAddAttributeNameAndRequired();//add
                bankingPaymentAddAttributeNameAndRequired();//add
            }
            else{
                jQuery('.cash_payment_section').hide();
                jQuery('.advance_payment_section').hide();
                jQuery('.banking_payment_section').hide();

                jQuery('.cash_payment_making_zero').val(0);
                jQuery('.advance_payment_making_zero').val(0);
                jQuery('.banking_payment_making_zero').val(0);

                emptyAndHideBankingOptionAllData();

                cashPaymentRemoveAttributeNameAndRequired();
                advancePaymentRemoveAttributeNameAndRequired();
                bankingPaymentRemoveAttributeNameAndRequired();
            }
            setTotalPayingAmountIsNotMoreThenInvoicePayableAmount();
            setTotalCurrentInvoiceDueAmount();
            submitButtonEnableDisabledAsRequirementByCalculation();
        });

        //cash payment making zero with hide options 
        function cashPaymentMakingZeroWithHide()
        {
            jQuery('.cash_payment_section').hide();
            jQuery('.cash_payment_making_zero').val(0);
        }
        //cash payment add attribute name and required 
        function cashPaymentAddAttributeNameAndRequired()
        {
            jQuery('.account_id_1').attr('name','account_id_1');
            jQuery('.account_id_1').attr('required',true);
        }
        //cash payment remove attribute name and required 
        function cashPaymentRemoveAttributeNameAndRequired()
        {
            jQuery('.account_id_1').removeAttr('required');
            jQuery('.account_id_1').removeAttr('name');
        }

        //advance payment making zero with hide options
        function advancePaymentMakingZeroWithHide()
        {
            jQuery('.advance_payment_section').hide();
            jQuery('.advance_payment_making_zero').val(0);
        }
        //advance payment  add attribute name and required
        function advancePaymentAddAttributeNameAndRequired()
        {
            jQuery('.account_id_2').attr('name','account_id_2');
            jQuery('.account_id_2').attr('required',true);
        }
        //advance payment  remove attribute name and required
        function advancePaymentRemoveAttributeNameAndRequired()
        {
            jQuery('.account_id_2').removeAttr('required');
            jQuery('.account_id_2').removeAttr('name');
        }

        //banking payment makeing zero with hide optoins
        function bankingPaymentMakingZeroWithHide()
        {
            jQuery('.banking_payment_section').hide();
            jQuery('.banking_payment_making_zero').val(0);
        }
        //banking payment  add attribute name and required
        function bankingPaymentAddAttributeNameAndRequired()
        {
            jQuery('.account_id_3').attr('name','account_id_3');
            jQuery('.account_id_3').attr('required',true);
        }
        //banking payment  remove attribute name and required
        function bankingPaymentRemoveAttributeNameAndRequired()
        {
            jQuery('.account_id_3').removeAttr('required');
            jQuery('.account_id_3').removeAttr('name');
        }

        //advance different paying amount option making disabled when advance zero
        function advanceDifferentPayingAmountOptionMakingDisabledWhenAdvancedZero()
        {
            var advanceAmount = nanCheckForSellPayment(parseFloat(jQuery('.total_advance_amount').val()));
            if(advanceAmount == 0)
            {
                jQuery('.advance_payment_value').val(0);
                jQuery('.advance_payment_value').attr('disabled',true);
                jQuery('.advance_payment_value').css({
                    'background-color':'red','color':'#ffff'
                });
            }else{
                jQuery('.advance_payment_value').removeAttr('disabled');
                jQuery('.advance_payment_value').css({
                    'background-color':'green','color':'#ffff'
                });
            }
        }



        //when change invoice continue with
        jQuery(document).on('change','.invoice_continue_with',function()
        {
            var invoice_continue_type = jQuery('.invoice_continue_with option:selected').val();
            if(invoice_continue_type == 1) //due
            {
                jQuery('.payment_option option[value=0]').prop('selected',true);
                jQuery('.payment_option').attr('disabled',true);
                paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZero();
                cashPaymentMakingZeroWithHide();
                advancePaymentMakingZeroWithHide();
                bankingPaymentMakingZeroWithHide();

                emptyAndHideBankingOptionAllData();
            }else{
                jQuery('.payment_option').removeAttr('disabled');

                //first time cash is open
                jQuery('.payment_option option[value=1]').prop('selected',true);
                jQuery('.cash_payment_section').show(300);
                jQuery('.cash_payment_value').focus();
            }
            submitButtonEnableDisabledAsRequirementByCalculation();
        });
        //payment Processing With Due Full Amount And Paying Amount Zero
        function paymentProcessingWithDueFullAmountAndPayingAmountZero()
        {
            var totalInvoicePayableAmount = nanCheckForSellPayment(parseFloat(jQuery('.total_invoice_payble_amount').text()));
            jQuery('.invoice_paying_amount').val(0);
            jQuery('.invoice_due_amount').val(totalInvoicePayableAmount);
        }
        //payment Processing With Due Full Amount And Paying Amount Disabled And Zero
        function paymentProcessingWithDueFullAmountAndPayingAmountDisabledAndZero()
        {
            var totalInvoicePayableAmount = nanCheckForSellPayment(parseFloat(jQuery('.total_invoice_payble_amount').text()));
            jQuery('.invoice_paying_amount').val(0);
            jQuery('.invoice_due_amount').val(totalInvoicePayableAmount);
            jQuery('.invoice_paying_amount').attr('readonly',true);

            //paying different method
            jQuery('.cash_payment_value').val(0);
            jQuery('.advance_payment_value').val(0);
            jQuery('.banking_payment_value').val(0);
        }


        //when pressing paying different method : keyup method
        jQuery(document).on('keyup','.paying_different_method',function()
        {
            var pressingAmount = nanCheckForSellPayment(parseFloat(jQuery(this).val()));
            var currentPressableAmount = setCurrentPressingDifferentAmountAfterAllCalculation(pressingAmount);
            jQuery(this).val(currentPressableAmount);

            calculationTotalPayingDifferentAllMethodsAmount();
            setTotalPayingAmountIsNotMoreThenInvoicePayableAmount();
            setTotalCurrentInvoiceDueAmount();

            submitButtonEnableDisabledAsRequirementByCalculation();
        });

        //set current pressing different amount after all calculation
        function setCurrentPressingDifferentAmountAfterAllCalculation(pressingAmount)
        { 
            var totalInvoicePayableAmount = nanCheckForSellPayment(parseFloat(jQuery('.total_invoice_payble_amount').text()));
            var totalDifferentAmountExceptCurrentType = getTotalPayingDifferentAmountExceptCurrentPressingAmount(pressingAmount);
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
        function getTotalPayingDifferentAmountExceptCurrentPressingAmount(pressingAmount)
        {
            var total = calculationTotalPayingDifferentAllMethodsAmount();
            return total - pressingAmount;
        }

        //set total paying amount not more then invoice payable amount
        function setTotalPayingAmountIsNotMoreThenInvoicePayableAmount()
        {
            var totalInvoicePayableAmount = nanCheckForSellPayment(parseFloat(jQuery('.total_invoice_payble_amount').text()));
            var allMethodAmount =  calculationTotalPayingDifferentAllMethodsAmount();
        
            if(totalInvoicePayableAmount >= allMethodAmount)
            {
                jQuery('.invoice_paying_amount').val(allMethodAmount)
            }else{
                jQuery('.invoice_paying_amount').val(totalInvoicePayableAmount)
            }
        }

        //total paying from all different methods
        function calculationTotalPayingDifferentAllMethodsAmount()
        {
            var total = 0;
            jQuery(".paying_different_method").each(function() {
                total += nanCheckForSellPayment(parseFloat(jQuery(this).val()));
            });
            return total = ((total).toFixed(2));
        }

        //current invoice due amount
        function setTotalCurrentInvoiceDueAmount()
        {
            var totalInvoicePayableAmount = nanCheckForSellPayment(parseFloat(jQuery('.total_invoice_payble_amount').text()));
            //var currentInvoiceBeforePressingAmont = nanCheckForSellPayment(parseFloat(jQuery('.invoice_due_amount').val()));
            var currentPayingAmount = calculationTotalPayingDifferentAllMethodsAmount(); 
            var currentDue =  (totalInvoicePayableAmount - currentPayingAmount);
            jQuery('.invoice_due_amount').val(currentDue);
        }


        //banking option all data
        function emptyAndHideBankingOptionAllData()
        {
            jQuery('.rendering_payment_banking_option_data').html('');
            jQuery('.banking_option_data option[value=0]').prop('selected',true);
        }
        //change banking option data
        jQuery(document).on('change','.banking_option_data',function(){
            var banking_option_id = jQuery('.banking_option_data option:selected').val();
            submitButtonEnableDisabledAsRequirementByCalculation();
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
                        jQuery('.rendering_payment_banking_option_data').html(response.list);
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
        function submitButtonEnableDisabledAsRequirementByCalculation()
        {
            var invoice_continue_type = jQuery('.invoice_continue_with option:selected').val();
            //if(invoice_continue_type == 1)//due
            if(invoice_continue_type == 2)//payment
            {
                var totalPayingAmount = calculationTotalPayingDifferentAllMethodsAmount();
                
                var payment_option = jQuery('.payment_option option:selected').val();
            
                
                if(totalPayingAmount > 0 && payment_option > 0 &&  payment_option <= 3)
                {
                    submitButtonEnable();
                } 
                else if(totalPayingAmount > 0 && payment_option >= 4 &&  payment_option <= 7)
                {
                    var banking_option_id = jQuery('.banking_option_data option:selected').val();
                    if(banking_option_id > 0)
                    {
                        submitButtonEnable();
                    }else{
                        submitButtonDisabled();
                    }
                }
                else{
                    submitButtonDisabled();
                }
            }else{
                submitButtonEnable();
            }
            exchangeGivenAmountAfterCalculator();
        }
        //submit button disabled
        function submitButtonDisabled()
        {
            jQuery('.submitButton').attr('disabled',true); 
        }
        //submit button enabled
        function submitButtonEnable()
        {
            jQuery('.submitButton').removeAttr('disabled'); 
        }
        //enable disabled submit button


        //calculator
        jQuery(document).on('click','.customer_calculator_button',function(){
            jQuery('.customer_calculator').show(300);
            jQuery('.customer_calculator_button').hide(300);
        });
        jQuery(document).on('click','.customer_calculator_close',function(){
            jQuery('.customer_calculator').hide(300);
            jQuery('.customer_calculator_button').show(300);
        });
        jQuery(document).on('keyup','.given_amount_for_calculator',function()
        {
            exchangeGivenAmountAfterCalculator();
        });
        function exchangeGivenAmountAfterCalculator()
        {
            var invoice_amount = nanCheckForSellPayment(parseFloat(jQuery('.total_invoice_amount_for_calculator').val()));
            var paing_amount_cal = nanCheckForSellPayment(parseFloat(jQuery('.total_paying_amount_for_calculator').val()));
            var given_amount = nanCheckForSellPayment(parseFloat(jQuery('.given_amount_for_calculator').val()));
            
            if(paing_amount_cal > 0 && given_amount > 0 && given_amount > paing_amount_cal)
            {
                var totalReturnAmount = paing_amount_cal - given_amount;
                totalReturnAmount = totalReturnAmount.toFixed(2);
                jQuery('.return_amount_for_calculator').val(totalReturnAmount);
            }else{
                jQuery('.return_amount_for_calculator').val(0.0);
            }
        }
        //calculator
    /*
    |-------------------------------------------------------------------------------
    |-----------------------------------------------
    |payment processing all options, functions
    |----------------------------------------------
    */
      

    jQuery(document).on("submit",'.storeSingleInvoiceWisePaymentData',function(e){
        e.preventDefault();
        $('.alert_success_message_div').hide();
        $('.success_message_text').text('');
        $('.alert_danger_message_div').hide();
        $('.danger_message_text').text('');

        var form = jQuery(this);
        var url = form.attr("action");
        var type = form.attr("method");
        var data = form.serialize();
        jQuery.ajax({
            url: url,
            data: data,
            type: type,
            datatype:"JSON",
            beforeSend:function(){
                jQuery('.processing').fadeIn();
            },
            success: function(response){
                if(response.status == true)
                {
                    $('#sellViewSingleInvoiceReceivePaymentModal').html('');
                    $('#sellViewSingleInvoiceReceivePaymentModal').html(response.html).modal('show');
                    paymentProcessingWithDueFullAmountAndPayingAmountZero();
                    jQuery.notify(response.message, response.type);
                    $('.success_message_text').html(response.message);
                }else{
                    $('.alert_danger_message_div').show();
                    $('.danger_message_text').text(response.message);
                }
            },
            complete:function(){
                jQuery('.processing').fadeOut();
            },
        });
        //end ajax
    });


    
    function nanCheckForSellPayment(value)
    {
        if(isNaN(value))
        {
            return 0;
        }
        else{
            return value;
        }
    }