import java.util.Arrays;

public class StringTest {
    public static void main(String[] args) {
  
        String myString = "hello world";
        String myString2 = myString;
        // myString = "ABCDE";
        // myString2 = "abc";
        myString2 = "!!hello, my world!!  ";

        myString2 = myString2.replace('l', '*');
        myString = myString.replace('l', '*');
        
        System.out.println(myString);
        System.out.println(myString2);

        //转义
        String myString3 = "hello, \"mark\"";
        System.out.println(myString3);





    }
}