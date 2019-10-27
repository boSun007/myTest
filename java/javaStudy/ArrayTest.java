import java.util.Arrays;

public class ArrayTest {
    public static void main(String[] args) {
        int[] myIntArray = new int[7];
        myIntArray[1] = 1;
        myIntArray[2] = 2;

        int[] myIntArray2 = { 2, 3, 4, 5, 6, 7 };


        String arrayString = Arrays.toString(myIntArray);
        System.out.println(Arrays.toString(myIntArray));
        System.out.println(arrayString);
        System.out.println(Arrays.toString(myIntArray2));

        //Multi-demonational array
        int[][] myMultiArray = new int[2][3];
        int[][] myMultiArrayNew = {{1,2},{1,2,3}};


        System.out.println(Arrays.deepToString(myMultiArray));
        System.out.println(Arrays.deepToString(myMultiArrayNew));




    }
}