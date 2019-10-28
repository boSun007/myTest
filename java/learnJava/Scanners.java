import java.util.Scanner;
public class Scanners{
	public static void main(String[] args){
		Scanner scanner = new Scanner(System.in);
//		byte age = scanner.nextByte();
//		System.out.println("your are "+ age);
//		String string = scanner.next();
//		System.out.println("you have typed: "+string);
		String wholeLine = scanner.nextLine().trim();
		System.out.println("you are typed: "+wholeLine);
	}
}


