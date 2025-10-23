class Math {
        public static void main(String[] args) {
        Math mathTests = new Math();

        int maxResult = mathTests.max(5, 12);
        System.out.println(maxResult);

        int minResult = mathTests.min(69, 12);
        System.out.println(minResult);

        int powResult = mathTests.power(3, 3);
        System.out.println(powResult);

        int modResult = mathTests.mod(69, 5);
        System.out.println(modResult);

        int subResult = mathTests.sub(10, 5);
        System.out.println(subResult);

        int multresult = mathTests.multiply(1, 2);
        System.out.println(multresult);

        Double divideResult = mathTests.Divide(10.0, 6.0);
        System.out.println(divideResult);
    }

    public int max(int a, int b){
        if(a > b){
            return a;
        }
        else if (b > a){
            return b;
        }
        else{
            return a;
        }
    }
    public int min(int a, int b){
        if(a > b){
            return b;
        }
        else if (b > a){
            return a;
        }
        else{
            return a;
        }
    }

    public int power(double base, double coefficient) {
        int result = (int) java.lang.Math.pow(base, coefficient);
        return result;
    }

    public int mod(int dividend, int divisor) {
        int result = dividend % divisor;
        return result;
    }

    public int sub(int a, int b) {
        return a - b;
    }

    public int multiply(int a, int b){
        int result = a * b;
        return result;
    }

    public Double Divide(Double a, Double b) {
        Double result = a / b;
        return result;
    }

}
