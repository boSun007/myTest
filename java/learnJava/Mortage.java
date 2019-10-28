import java.text.NumberFormat;
import java.util.Scanner;
public class Mortage{
	public static void main(String[] args){
		Scanner scanner = new Scanner(System.in);
		System.out.print("principal: ");
		double principal = scanner.nextDouble();
		System.out.print("Year Interest Rate: ");
		float yearInterest = scanner.nextFloat();
		System.out.print("Payments:");
		int payments = scanner.nextInt();
		double payment = claMortage(principal,yearInterest,payments);
		NumberFormat pay = NumberFormat.getCurrencyInstance();
		String monthPayment = pay.format(payment);
		System.out.println("your monthly payment is: "+monthPayment);
	}

	private static double claMortage(double principal, float yearInterest, int payments){
		yearInterest = yearInterest/100;
		double num = Math.pow((1 + yearInterest/12),(payments*12));
		double p = (principal * (yearInterest/12 * num)/(num-1));
		return p;



	}
}
