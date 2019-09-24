import java.lang.reflect.Array;
import java.util.Random;
import java.util.Scanner;

class tripleAdd{
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);
        System.out.println("hello, Angela, how many numbers do you want to add?");
        System.out.println("here we go!");
        int num = input.nextInt();
        tripleAdd obj = new tripleAdd();
      
        
        for(int i =0; i<4;i++){

            obj.dispaly(input, num);
        }
       
    }

    private static void dispaly(Scanner input, int num){
     
        Random randomNum = new Random();

        int[] numArr = new int[num];

        int sum =0;
        for(int i = 0; i<num; i++){
            numArr[i]=randomNum.nextInt(9)+1;
            sum+=numArr[i];
            System.out.print(numArr[i]);
            
            if(i<num-1){
                System.out.print("+");
            }else{
                System.out.print("= ");
            }
        }
       
        
        tripleAdd obj = new tripleAdd();
       
            obj.checkResult(input,sum);
       

    }

    private static boolean checkResult(Scanner input, int result){
        tripleAdd obj = new tripleAdd();
        int inputNum = input.nextInt();
        if(inputNum != result){
            System.out.println("not right, please try again");
            tripleAdd.checkResult(input, result);
            
        }else{
            System.out.println("Well Done!! Angela you are the best!");
        }
            return true;
    }
}