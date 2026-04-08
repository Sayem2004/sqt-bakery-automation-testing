from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time
import random

driver = webdriver.Chrome()

try:
    print("Step 1: Registration")

    driver.get("http://localhost/Bakery_Hub_new/common/View/register.php")
    driver.maximize_window()
    time.sleep(2)

    email = f"user{random.randint(1000,9999)}@test.com"

    driver.find_element(By.ID, "name").send_keys("Test User")
    driver.find_element(By.ID, "phone").send_keys("01711111111")
    driver.find_element(By.ID, "email").send_keys(email)
    driver.find_element(By.ID, "password").send_keys("123456")

    Select(driver.find_element(By.ID, "role")).select_by_value("customer")

    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(3)

    print("Registration Done")

    # --------------------------

    print("Step 2: Login")

    driver.get("http://localhost/Bakery_Hub_new/common/View/login.php")
    time.sleep(2)

    driver.find_element(By.ID, "email").send_keys(email)
    driver.find_element(By.ID, "password").send_keys("123456")

    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(3)

    print("Login Done")

    # --------------------------

    print("Step 3: Place Order")

    driver.get("http://localhost/Bakery_Hub_new/customer/view/customer_dashboard.php?page=order")
    time.sleep(2)

    Select(driver.find_element(By.NAME, "product_id")).select_by_index(1)
    driver.find_element(By.NAME, "quantity").send_keys("2")

    driver.find_element(By.NAME, "place_order").click()
    time.sleep(3)

    print("Order Placed")

    # --------------------------

    print("Step 4: My Orders")

    driver.get("http://localhost/Bakery_Hub_new/customer/view/customer_dashboard.php?page=orders")
    time.sleep(3)

    # --------------------------

    print("Step 5: Pay")

    driver.find_element(By.XPATH, "//a[contains(text(),'Pay')]").click()
    time.sleep(3)

    # --------------------------

    print("Step 6: Invoice")

    driver.get("http://localhost/Bakery_Hub_new/customer/view/customer_dashboard.php?page=invoices")
    time.sleep(3)

    # --------------------------

    print("Step 7: Logout")

    driver.find_element(By.LINK_TEXT, "Logout").click()
    time.sleep(2)

    print("All steps completed successfully")

except Exception as e:
    print("Error:", e)

finally:
    driver.quit()